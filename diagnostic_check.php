<?php
/**
 * Diagnostic script to check request records and identify serialization issues
 * Deploy this to the server and access via browser to diagnose the unserialize error
 */

// Establish database connection
$mysqli = mysqli_connect("localhost", "preprod_user", "!1q2w3eZ", "preprod");

if (!$mysqli) {
    die("<h1>Database Connection Failed</h1><p>" . mysqli_connect_error() . "</p>");
}

mysqli_set_charset($mysqli, "utf8");

echo "<html><head><title>Database Diagnostic Report</title>";
echo "<style>
body { font-family: monospace; margin: 20px; background: #f5f5f5; }
h1, h2 { color: #333; }
table { border-collapse: collapse; width: 100%; background: white; margin: 20px 0; }
th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
th { background-color: #4CAF50; color: white; }
tr:nth-child(even) { background-color: #f2f2f2; }
.error { background-color: #ffebee !important; color: #c62828; }
.success { background-color: #e8f5e9 !important; color: #2e7d32; }
.warning { background-color: #fff3e0 !important; color: #f57c00; }
pre { background: #f5f5f5; padding: 10px; overflow-x: auto; }
</style></head><body>";

echo "<h1>InkRockit Database Diagnostic Report</h1>";
echo "<p>Generated: " . date('Y-m-d H:i:s') . "</p>";

// Get total count
$count_result = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM requests");
$count_row = mysqli_fetch_assoc($count_result);
echo "<h2>Total Requests: {$count_row['total']}</h2>";

// Get recent requests
$result = mysqli_query($mysqli, "SELECT id, user_id, company_id, order_data, request_date, industry
                                  FROM requests
                                  ORDER BY id DESC
                                  LIMIT 20");

if (!$result) {
    die("<p class='error'>Query failed: " . mysqli_error($mysqli) . "</p>");
}

echo "<h2>Recent 20 Requests Analysis</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Date</th><th>User ID</th><th>Company ID</th><th>Industry</th><th>Data Length</th><th>Format</th><th>Status</th><th>Sample Data</th></tr>";

$errors = [];
$base64_encoded = [];
$plain_serialized = [];

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $data_length = strlen($row['order_data']);
    $sample = htmlspecialchars(substr($row['order_data'], 0, 80));

    $format = "Unknown";
    $status_class = "";
    $status_message = "";

    // Check if it's base64 encoded
    $is_base64 = false;
    $decoded = base64_decode($row['order_data'], true);
    if ($decoded !== false && base64_encode($decoded) === $row['order_data']) {
        // It's valid base64
        if (substr($decoded, 0, 2) === 'a:' || substr($decoded, 0, 2) === 's:' || substr($decoded, 0, 2) === 'i:') {
            $format = "BASE64-Encoded Serialized";
            $is_base64 = true;

            // Try to unserialize the decoded data
            $unserialized = @unserialize($decoded);
            if ($unserialized === false && $decoded !== 'b:0;') {
                $status_class = "error";
                $status_message = "ERROR: Cannot unserialize decoded";
                $errors[] = $id;
            } else {
                $status_class = "warning";
                $status_message = "WARNING: Base64 format (needs conversion)";
                $base64_encoded[] = $id;
            }
        }
    }

    if (!$is_base64) {
        // Check if it's plain serialized
        if (substr($row['order_data'], 0, 2) === 'a:' || substr($row['order_data'], 0, 2) === 's:' || substr($row['order_data'], 0, 2) === 'i:') {
            $format = "Plain Serialized";

            // Try to unserialize directly
            $unserialized = @unserialize($row['order_data']);
            if ($unserialized === false && $row['order_data'] !== 'b:0;') {
                $status_class = "error";
                $status_message = "ERROR: Cannot unserialize";
                $errors[] = $id;
            } else {
                $status_class = "success";
                $status_message = "OK";
                $plain_serialized[] = $id;
            }
        } else {
            $format = "Unknown/Corrupted";
            $status_class = "error";
            $status_message = "ERROR: Unknown format";
            $errors[] = $id;
        }
    }

    echo "<tr class='$status_class'>";
    echo "<td>$id</td>";
    echo "<td>{$row['request_date']}</td>";
    echo "<td>{$row['user_id']}</td>";
    echo "<td>{$row['company_id']}</td>";
    echo "<td>" . htmlspecialchars($row['industry']) . "</td>";
    echo "<td>$data_length bytes</td>";
    echo "<td>$format</td>";
    echo "<td>$status_message</td>";
    echo "<td style='font-size: 10px;'>$sample...</td>";
    echo "</tr>";
}

echo "</table>";

// Summary
echo "<h2>Summary</h2>";
echo "<table>";
echo "<tr><th>Category</th><th>Count</th><th>IDs</th></tr>";
echo "<tr class='success'><td>Plain Serialized (OK)</td><td>" . count($plain_serialized) . "</td><td>" . implode(', ', $plain_serialized) . "</td></tr>";
echo "<tr class='warning'><td>Base64-Encoded (Needs Fix)</td><td>" . count($base64_encoded) . "</td><td>" . implode(', ', $base64_encoded) . "</td></tr>";
echo "<tr class='error'><td>Corrupted/Errors</td><td>" . count($errors) . "</td><td>" . implode(', ', $errors) . "</td></tr>";
echo "</table>";

// Recommendations
echo "<h2>Recommendations</h2>";
if (count($base64_encoded) > 0) {
    echo "<p class='warning'><strong>Action Required:</strong> " . count($base64_encoded) . " records are base64-encoded and need to be converted to plain serialized format for admin panel compatibility.</p>";
    echo "<p>Run this SQL to fix them:</p>";
    echo "<pre>UPDATE requests SET order_data = FROM_BASE64(order_data) WHERE id IN (" . implode(',', $base64_encoded) . ");</pre>";
}

if (count($errors) > 0) {
    echo "<p class='error'><strong>Critical:</strong> " . count($errors) . " records have corrupted data that cannot be unserialized.</p>";
    echo "<p>These records may need manual review or deletion.</p>";
}

if (count($base64_encoded) == 0 && count($errors) == 0) {
    echo "<p class='success'><strong>All Good!</strong> All recent records are in the correct format.</p>";
}

mysqli_close($mysqli);

echo "</body></html>";
