//make show shop
$(function () {
    $('#shop').hover(function (e) {
        $(this).addClass('bascetslide').css({
            'color': '#000000',
            'margin-top': '3px',
            'padding-top': '6px',
            'marginBottom': '0px',
            'paddingBottom': '9px',
            'paddingRight': '6px',
            'marginLeft': '0px',
            'width': '70px',
            'border-radius': '10px 10px 0px 0px '
        }).text()
        $('.bascetslidebar').show()
    }, function () {
        $(this).removeClass('bascetslide').removeAttr('style')
        $('.bascetslidebar').hide()
    })
})
$(function () {
    $('.itemDetailTitle').hover(function () {
        $(this).css('color', '#4e9000')
    }, function () {
        $(this).css('color', '#00286b')
    })
//click
    $('span[id*=img],.itemDetailTitle').click(function () {

        if ($(this).is('.ShowBox')) {

            $(this).parent().find('div').hide()
            $(this).removeClass('ShowBox')
            $(this).parent().find('span').find('img').attr('src', '/image/hide.png')

        } else {
            $('.ShowBox').parent().each(function () {
                $(this).find('div').hide()
                $(this).children('span,p').removeClass('ShowBox')
                $(this).find('span').find('img').attr('src', '/image/hide.png')

            })
            $(this).parent().find('span').find('img').attr('src', '/image/show.png')
            $(this).parent().find('div').show()


            $(this).parent().find('span,p:first').addClass('ShowBox')


        }

    })


//hover
//    $('.details').each(function(){
//            $(this).stop().hide() 
//            $(this).parent().find('span').find('img').attr('src','/image/customArrovDown.png')
//
//        })
//    $('span[id*=img],.itemDetailTitle').hover(function(){
//        $('.details').each(function(){
//            $(this).stop().hide() 
//            $(this).parent().find('span').find('img').attr('src','/image/customArrovDown.png')
//
//        })
//        $(this).parent().find('span').find('img').attr('src','/image/customArrovDown.png')
//        $(this).parent().find('div').delay(100).show(1000)  
//    },function(){
//        $(this).parent().find('span').find('img').attr('src','/image/customArrovDown.png')
//        $(this).parent().find('div').hide()
//    })
})
//remove border from last Nav
$(function () {
    $('#contentNav > a:last').css({
        'borderRight': 'none',
        'borderRadius': '0px 11px 0px 0px'
    })
})


$(function () {
    $('.Landlogos').css('cursor', 'pointer');
    $('.mainFooterFirstBlock,.mainFooterSecondBlock,.mainFooterThirdBlock,.landingLeft,.Landlogos,.logo').click(function () {
        window.open(' http://www.inkrockit.com/custom_page.php', '')
    })
//    $('.headbutton').click(function(){
////        window.open('http://www.inkrockit.com/request/', 'strWindowName')
//        window.open('http://www.inkrockit.com/request/','','Toolbar=1,Location=0,Directories=0,Status=0,Menubar=0,Scrollbars=1,Resizable=0,Width=500,Height=840')
//    })
    $('.headbutton').css({
        'backgroundPosition': 'bottom'

    })
    $('.headbutton').hover(function () {
        $(this).css({
            'backgroundPosition': 'top'
        })
    }, function () {
        $(this).css({
            'backgroundPosition': 'bottom'

        })
    })
})

//under top menu
$(function () {
    $('.basketNav a:not(.basketNav a:last)').hover(function () {
        $(this).css('textDecoration', 'underline')
    }, function () {
        $(this).css('textDecoration', 'none')
    })


})
$(function () {
    $('#basketButton').hover(function () {
        $(this).css({
            'background': ' url("/image/buttonBgSelect.png") repeat-x '
        })
    }, function () {
        $(this).css({
            'background': ' url("/image/buttonBg.png") '

        })
    })
})
$(function () {
    $('#editBasketItem,#dellBascetItem').hover(function () {
        $(this).css('textDecoration', 'underline')
    }, function () {
        $(this).css('textDecoration', 'none')
    })
})
////make show Menu
$(function () {
    var quest = $('#contentNav > a:not(a:first)')
    var Last = quest.last()
    quest.each(function () {
        $(this).hover(function () {
            if ($(this).attr('id') == Last.attr('id')) {
                $(this).css({
                    'background': 'url(/image/NavBgSelect2.png) repeat-x',
                    'borderRadius': '0px 7px 0px 0px '
                })
            } else {
                $(this).css({
                    'background': 'url(/image/NavBgSelect2.png) repeat-x'
                })
            }

            $($(this).children('div')).css('z-index', '1000').show()
        }, function () {
            if ($(this).attr('id') == Last.attr('id')) {
                $(this).css({
                    'background': 'none',
                    'borderRadius': '0px 10px 10px 0px '
                })
            } else {
                $(this).css({
                    'background': 'none'
                })
            }
            $($(this).children('div')).hide()
        })
    })
})
//top menu list arrow click
$(function () {
    $('.leftMenuArrowTop').click(function () {


        firstChildren = $(this).parent().find('div.moreItem').children().first('div')
        lastChildren = $(this).parent().find('div.moreItem').children().last('div')
        console.log(firstChildren)

        firstChildren.before(lastChildren)
    })
    $('.rightMenuArrowTop').click(function () {
        firstChildren = $(this).parent().find('div.moreItem').children().first('div')
        lastChildren = $(this).parent().find('div.moreItem').children().last('div')
        lastChildren.after(firstChildren)
    })
})
//hover image
$(function () {
    $('#imgRel > img,#imgRelNew > img').hover(function () {
        $(this).css({
            'padding': '0px',
            'boxShadow': '0px 0px 1px 4px #5faa00 '

        })
    }, function () {
        $(this).css({
            'padding': '0px',
            'boxShadow': '0px 0px 0px 0px #5faa00 '

        })
    })
})
//home button 


$(function () {
    $('#contentNav > a:first').find('img').attr('src', '/image/newHome.png')
//    $('#contentNav > a:first').hover(function(){  
//        $(this).find('img').attr('src','/image/newHome.png')
// 
//    },function(){
//        $(this).find('img').attr('src','/image/house.png') 
//    })


})
$(function () {
    $('#contentNav > a:first').width('50px')
        .css({
            'background': 'url(/image/NavBgSelect.png) repeat-x',
            'borderRadius': '8px 0px 0px 8px'
        })

//    $('#contentNav > a:first').width('50px')
//    $('#contentNav > a:first').hover(function(){
//        $(this).css({
//            'background':'url(/image/NavBgSelect.png) repeat-x',
//            'borderRadius':'8px 0px 0px 8px'
//        })
//    },function(){
//        $(this).css({
//            'background':'none'
//        })
//    })
})

//print it li last border not display
$(function () {
    var elems = $('.printNav li');
    var lastid = $('.printNav li').length;
    var prevLast = lastid - 1;
    if (parseFloat(lastid / 2) == parseInt(lastid / 2)) {
        $('#li' + lastid + ',#li' + prevLast).css({
            'borderBottom': '1px solid transparent'
        })
    } else {
        $('#li' + lastid).css({
            'borderBottom': '1px solid transparent'
        })
    }
    //     var elems = $('.printNav li');
    var lastprintid = $('.custprintNav li').length;
    var prevLastprint = lastprintid - 1;
    if (parseFloat(lastprintid / 2) == parseInt(lastprintid / 2)) {
        $('li[name=li' + lastprintid + '],li[name=li' + prevLastprint + ']').css({
            'borderBottom': '1px solid transparent'
        })
    } else {
        $('li[name=li' + lastprintid + ']').css({
            'borderBottom': '1px solid transparent'
        })
    }
})


var countInsp = 0;
$(function () {
    //start hover
    function Insp() {
        countInsp++;
        if (countInsp == 5) {
            console.log($('.triggered'))
            $('.triggered').trigger('click')
        }
    }

    $('.InspirationArtikle').mouseenter(function () {
        $(this).addClass('triggered');
        slideInsp = setInterval(Insp, 100)
    })
    $('.InspirationArtikle').mouseleave(function () {
        $('.InspirationArtikle').each(function () {
            $(this).removeClass('triggered')
        })
        clearInterval(slideInsp);
        countInsp = 0;
    })
    //end hover   
    //start click
    $('.InspirationArtikle').live('click', function () {


        if ($(this).is('.newClassTopSlider')) {
            $('.inspcontent').slideUp()


            $(this).removeClass('newClassTopSlider').css({
                'backgroundColor': '#3c3c3c',
                'color': '#ffffff',
                'borderRadius': '10px 10px 10px 10px'
            })
            //            $(this).find('span.Insp').find('img').attr('src','/image/insphide.png')

            return false;
        }
        ;
        $('.InspirationArtikle').each(function () {


            $(this).removeClass('newClassTopSlider').css({
                'backgroundColor': '#3c3c3c',
                'color': '#ffffff',
                'borderRadius': '10px 10px 10px 10px'
            })
            //            $(this).find('span.Insp').find('img').attr('src','/image/insphide.png')
            //            $(this).find('span.Insp').find('img').attr('src','/image/customArrovDown.png')
        })
        $('.inspcontent').slideUp()
        $(this).next('.inspcontent').slideDown()
        $('.InspirationArtikle').removeClass('newClassTopSlider')
        $(this).addClass('newClassTopSlider')

            .css({
                'backgroundColor': '#ffffff',
                'color': '#00286b',
                'borderRadius': '10px 10px 0 0'
            })
        //        $(this).find('span.Insp').find('img').attr('src','/image/inspshow.png')
    })
//      end click
})


//        if($(this).is('.newClassTopSlider')){
//            $(this).css({
//                'backgroundColor':'#3c3c3c',
//                'color':'#ffffff',
//                'borderRadius':'10px 10px 10px 10px'
//            }).removeClass('newClassTopSlider')
//            $(this).find('span.Insp').find('img').attr('src','/image/insphide.png')
//            $('div[name='+$(this).attr('id')+']').hide() 
//        }else{
//            $('div[class*=InspirationArtikle]').each(function(){
//                $(this).css({
//                    'backgroundColor':'#3c3c3c',
//                    'color':'#ffffff',
//                    'borderRadius':'10px 10px 10px 10px'
//                }).removeClass('newClassTopSlider')
//                $(this).find('span.Insp').find('img').attr('src','/image/insphide.png')
//                $('div[name='+$(this).attr('id')+']').hide()    
//            })
//            $(this).css({
//                'backgroundColor':'#ffffff',
//                'color':'#00286b',
//                'borderRadius':'10px 10px 0 0'
//            }).addClass('newClassTopSlider')
//            $('div[name='+$(this).attr('id')+']').slideDown(500)
//            //            console.log(('div[name='+$(this).attr('id')+']'))
//            $(this).find('span.Insp').find('img').attr('src','/image/inspshow.png'). addClass('newClassTopSlider')
//            
//            
//            
//            
//        }


//left menu show/hide
$(function () {
    $('.mainLeftMenuTopHead').each(function () {
        $(this).css({
            'borderRadius': '8px 8px 0px 0px',
            'borderBottom': '1px solid #fff'
        })
        $(this).next('div').show()
        $(this).toggle(function () {
            $($(this).next('div')).slideDown(500)
            $(this).css({
                'borderRadius': '8px 8px 0px 0px',
                'borderBottom': '1px solid #fff'
            })
        }, function () {
            $($(this).next('div')).slideUp(500)
            $(this).css({
                'borderRadius': '8px 8px 8px 8px',
                'borderBottom': 'none'
            })
        })
    })
})

//left top menu see content
$(function () {
    $('div[id*=menuArticle]').click(function () {
        //            Id=$(this).attr('id')  

        if ($(this).attr('name') == 'open') {
            $('div[name=' + $(this).attr('id') + ']').slideUp('500')
            $(this).children('span').find('img').attr('src', '/image/hide.png')
            $(this).removeAttr('name', 'open')
            $(this).css({
                'backgroundColor': '#3c3c3c'
            })
        } else {
            $('div[name=' + $(this).attr('id') + ']').slideDown('500')
            $(this).children('span').find('img').attr('src', '/image/show.png')
            $(this).attr('name', 'open')
            $(this).css({
                'backgroundColor': '#2d2d2d'
            })
        }

    })
})
//add to cart hover
$(function () {
    $('.AddToCart').hover(function () {
        $(this).css({
            'color': '#91db47',
            'boxShadow': '0 0 1px 3px #87c00d'
        })
        $(this).find('span').css('color', '#91db47').find('img').attr('src', '/image/DownloadArrowSel.png')
    }, function () {
        $(this).css({
            'color': '#ffffff',
            'boxShadow': '0 0 1px 3px #a6ce39'
        })
        $(this).find('span').css('color', '#ffffff').find('img').attr('src', '/image/DownloadArrow.png')
    })
})

//left menu show/hide
//$(function(){
//    
//    $('.mainLeftMenuTopHead').each(function(){
//         $( $(this).next('div')).css({
//                'borderRadius':'8px 8px 0px 0px',
//                'borderBottom':'1px solid #fff'
//            }).show()
//        $(this).toggle(function(){
//            $( $(this).next('div')).slideDown(500) 
//            $(this).css({
//                'borderRadius':'8px 8px 0px 0px',
//                'borderBottom':'1px solid #fff'
//            })
//        },function(){
//            $( $(this).next('div')).slideUp(500)
//            $(this).css({
//                'borderRadius':'8px 8px 8px 8px',
//                'borderBottom':'none'
//            })
//        })
//    })
//})
//
////left top menu see content
//$(function(){
//    $('div[id*=menuArticle]').toggle(function(){
//        Id=$(this).attr('id') 
//      $('div[name='+$(this).attr('id')+']').slideUp('500')
//            $('div[id='+Id+'] span img').attr('src','/image/hide.png')
//      
//    }, function(){
//        Id=$(this).attr('id') 
//       $('div[name='+$(this).attr('id')+']').hide()  
//            $('div[id='+Id+'] span img').attr('src','/image/hide.png') 
//    })
//        .click(function(){
//            
//            if($(this).attr('name')=='selected'){
//            Id=$(this).attr('id')  
//            $(this).removeAttr('name')
//            $('div[name='+$(this).attr('id')+']').slideUp('500')
//            $('div[id='+Id+'] span img').attr('src','/image/hide.png')
//         
//       
//            }else{
//              $('div[id*=menuArticle]').each(function(){
//                  $(this).removeAttr('name')
//                  Id=$(this).attr('id')   
//            $('div[name='+$(this).attr('id')+']').hide()  
//            $('div[id='+Id+'] span img').attr('src','/image/hide.png')
//              })
//              Id=$(this).attr('id')   
//            $('div[name='+$(this).attr('id')+']').slideDown('500')  
//            $('div[id='+Id+'] span img').attr('src','/image/show.png')
//            $(this).attr('name','selected')
//                
//            }
//        })

//})

//downloadButton show/hide

//$('.downloadTemplate').click(function(){
//    $('.ChouseDownloadTemplate').show()
//})
//$('.downloadBlock').mouseleave(function(){
//     $('.ChouseDownloadTemplate').hide()
//})
//$(function(){
//$('.downloadTemplate').click(function(e){
//    
//    $('.ChouseDownloadTemplate').show() 
//    console.log(bottomPosition= $(".downloadTemplate").offset().top + $(".downloadTemplate").height() )
//   console.log(leftPosition= $(".downloadTemplate").offset().left )
// while(e.pageX>leftPosition && e.pageX<leftPosition+200 && e.pageY<bottomPosition && e.pageY>bottomPosition+200){
//   $('.ChouseDownloadTemplate').show()
//   console.log(e.pageX)
// }
$(function () {
    $('.downloadTemplate').click(function () {
        $('.ChouseDownloadTemplate').show()
        $('.downloadArrow').css({
            'backgroundImage': 'url("/image/newMinus.png")'
        })
    })
    $('.ChouseDownloadTemplate').mouseleave(function () {
        $('.ChouseDownloadTemplate').hide()
        $('.downloadArrow').css({
            'backgroundImage': 'url("/image/newPlus.png")'
        })
    })
})
//})
//
$(function () {
    $('.typeDownload').find('img').click(function () {
        alert('start Download ')
    })
})


$(function () {
    $('div .rotatorLeft ,div .rotatorRight').animate({
        opacity: 0
    }, 2000).hide();
    //    $('div .rotatorBlockLeft ,div .rotatorBlockRight').hover(function(){
    //        $('div .rotatorLeft ,div .rotatorRight').stop(true,false).animate({'opacity':1},1);
    //    });

    $('.rotator').hover(function () {
        //        $('.rotatorBlockLeft, .rotatorBlockRight').mouseover(function(){
        //            $('div .rotatorLeft ,div .rotatorRight').fadeOut(4000);
        //        })
        $(' .rotatorBlockRight').mouseover(function () {
            $('div .rotatorRight').show().stop().animate({
                opacity: 1
            }, 100);
        });

        $('.rotatorBlockLeft').mouseover(function () {
            $('div .rotatorLeft ').show().stop().animate({
                opacity: 1
            }, 100);
        });

        $('.rotatorBlockLeft,.rotatorBlockRight').mouseleave(function () {
            wasThere = 1;
            console.log(wasThere)
            $('div .rotatorLeft ,div .rotatorRight').stop().animate({
                opacity: 0
            }, 1000);
        })
        //        $('.rotatorBlockCenter').click(function(){
        //           $('.rotatorBg img').trigger('click')
        //        })
    }, function () {
        $('div .rotatorLeft ,div .rotatorRight').animate({
            opacity: 0
        }, 500);
    })


})
//image click
$(function () {
    $('img[id*=insp]').click(function () {
        $('.mainPage').hide()
        $('.mainContent').show()
        $('#InspirationContent').hide()
        $('.mediakits').hide();
    })
})
$(function () {
    $('#contentNav > a:first').click(function (e) {
        e.preventDefault()
        $('.mainPage').show()
        $('.mainContent').hide()
        $('.mediakits').hide();
    })
})
$(function () {
    $('.printNav li').click(function () {
        $('#printContent').hide()
        $('.mainPage').hide()
        $('.mainContent').hide()
        $('.mediakits').show()
    })
})
//hover nav li 
$(function () {
    $('.printNav li').hover(function () {
        $(this).css('color', '#91db47')
    }, function () {
        $(this).removeAttr('style')
    })
})
//center rotator
$(function () {
    //move he last list item before the first item. The purpose of this is if the user clicks to slide left he will be able to see the last item.
    $('#carousel_ul li:last').after($('#carousel_ul li:first'));

    imgBg = $('#carousel_ul > li[name*=cat]').last().find('img')

    $('.rotatorBg img').attr('name', imgBg.attr('id')).attr('src', imgBg.attr('src')).css({
        'max-width': '625px',
        'height': '507px'
    }).addClass('dg-picture-zoom')
    imgright = $('#carousel_ul li[name*=cat]').first().find('img')
    $('.imgDivR').html('<img src="' + imgright.attr('src') + '" name="' + imgright.attr('id') + '" style="width:76px;height:100px">')
    imgleft = $('#carousel_ul > li[name*=cat]').eq(-2).find('img')
    $('.imgDiv').html('<img src="' + imgleft.attr('src') + '" name="' + imgleft.attr('id') + '" style="width:76px;height:100px">')


    //when user clicks the image for sliding right
    $('.rightMenuArrow').click(function () {
        zminna = $('#carousel_ul > li').eq(0).attr('name')
        if (zminna) {
            imgBg = $('#carousel_ul > li[name*=cat]').first().find('img')
            imgleft = $('#carousel_ul > li[name*=cat]').eq(-1).find('img')
            imgright = $('#carousel_ul li[name*=cat]').eq(1).find('img')
        } else {
            imgBg = $('#carousel_ul > li[name*=cat]').last().find('img')
            imgright = $('#carousel_ul li[name*=cat]').first().find('img')
            imgleft = $('#carousel_ul > li[name*=cat]').eq(-2).find('img')
        }


        $('.rotatorBg img').attr('name', imgBg.attr('id')).attr('src', imgBg.attr('src')).css({
            'max-width': '625px',
            'height': '507px'
        }).addClass('dg-picture-zoom')
        //   
        $('.imgDivR').html('<img src="' + imgright.attr('src') + '" name="' + imgright.attr('id') + '" style="width:76px;height:100px">')

        $('.imgDiv').html('<img src="' + imgleft.attr('src') + '" name="' + imgleft.attr('id') + '" style="width:76px;height:100px">')
        //get the width of the items ( i like making the jquery part dynamic, so if you change the width in the css you won't have o change it here too ) '
        var item_width = $('#carousel_ul li').outerWidth() + 0;
        //calculae the new left indent of the unordered list
        var left_indent = parseInt($('#carousel_ul').css('left')) - item_width;
        //make the sliding effect using jquery's anumate function '
        $('#carousel_ul:not(:animated)').animate({
            'left': left_indent
        }, 500, function () {
            //get the first list item and put it after the last list item (that's how the infinite effects is made) '
            $('#carousel_ul li:last').after($('#carousel_ul li:first'));
            //and get the left indent to the default -210px
            $('#carousel_ul').css({
                'left': '0px'
            });
        });
    });
    //when user clicks the image for sliding left
    $('.leftMenuArrow').click(function () {
        imgBg = $('#carousel_ul > li[name*=cat]').last().find('img')

        $('.rotatorBg img').attr('name', imgBg.attr('id')).attr('src', imgBg.attr('src')).css({
            'max-width': '625px',
            'height': '507px'
        }).addClass('dg-picture-zoom')
        imgright = $('#carousel_ul li[name*=cat]').first().find('img')
        $('.imgDivR').html('<img src="' + imgright.attr('src') + '" name="' + imgright.attr('id') + '" style="width:76px;height:100px">')
        imgleft = $('#carousel_ul > li[name*=cat]').eq(-2).find('img')
        $('.imgDiv').html('<img src="' + imgleft.attr('src') + '" name="' + imgleft.attr('id') + '" style="width:76px;height:100px">')

        var item_width = $('#carousel_ul li').outerWidth() + 0;
        /* same as for sliding right except that it's current left indent + the item width (for the sliding right it's - item_width) */
        var left_indent = parseInt($('#carousel_ul').css('left')) + item_width;
        $('#carousel_ul:not(:animated)').animate({
            'left': left_indent
        }, 500, function () {
            /* when sliding to left we are moving the last item before the first list item */
            $('#carousel_ul li:first').before($('#carousel_ul li:last'));
            /* and again, when we make that change we are setting the left indent of our unordered list to the default -210px */
            $('#carousel_ul').css({
                'left': '0px'
            });
        });
    });
});
var wasThere = 2;
//rotator mouseOver
$(function () {
    $('.rotatorBg :not(.rotatorLeft,.rotatorRight)').mouseleave(function () {
        //        $('.rotatorLeft,.rotatorRight').hide() 
        wasThere = 2;

    })

    $('.rotatorBg').mouseenter(function () {

        if (wasThere != 1) {
            console.log(wasThere)
            $('.rotatorLeft,.rotatorRight').stop().show().css('opacity', '1').animate({
                opacity: 0
            }, 2000)
            wasThere = 1;
            //        }else{
            //          $('.rotatorLeft,.rotatorRight').hide()
        }
    })
})

//click arrow right
$(function () {
    $('.rotatorRight').click(function () {

        right = $('.imgDivR').find('img').attr('name')

        while (right != $('#carousel_ul > li').eq(0).find('img').attr('id')) {
            //            alert('robut')
            var item_width = $('#carousel_ul li').outerWidth() + 0;
            //calculae the new left indent of the unordered list
            var left_indent = parseInt($('#carousel_ul').css('left')) - item_width;

            //and get the left indent to the default -210px
            $('#carousel_ul').css({
                'left': '0px'
            });

            $('#carousel_ul li:last').after($('#carousel_ul li:first'));
        }
        $('.rightMenuArrow').trigger('click')
    });
})
$(function () {
    $('.rotatorLeft').click(function () {

        left = $('.imgDiv').find('img').attr('name')

        while (left != $('#carousel_ul > li').eq(0).find('img').attr('id')) {
            //            alert('robut')
            var item_width = $('#carousel_ul li').outerWidth() + 0;
            //calculae the new left indent of the unordered list
            var left_indent = parseInt($('#carousel_ul').css('left')) + item_width;

            //and get the left indent to the default -210px
            $('#carousel_ul').css({
                'left': '0px'
            });

            $('#carousel_ul li:first').before($('#carousel_ul li:last'));
        }
        $('.rightMenuArrow').trigger('click')
    });
})
$(function () {
    lastImgId = $('#carousel_ul li:last ').prev().find('img').attr('id')
    $('#carousel_ul li ').find('img').click(function () {

        imgId = $(this).attr('id')
        keyImgR = imgId
        keyImgL = imgId
        keyR = ''
        keyL = ''
        while (keyR == '') {

            keyR = $('#carousel_ul li ').find('img[id=' + keyImgR + ']').parent().next().attr('name')
            if (keyR) {
            } else {
                keyR = ''
            }
            if (keyImgR == lastImgId) {
                keyImgR = '1';
            } else {
                keyImgR++;
            }
        }
        while (keyL == '') {
            keyImgL--;
            //               console.log(keyL)
            //               console.log($('#carousel_ul li ').find('img[id=1]').parent().attr('name'))
            keyL = $('#carousel_ul li ').find('img[id=' + keyImgL + ']').parent().attr('name')
            if (keyImgL == '0') {
                keyImgL = lastImgId
            }
            if (keyL) {

            } else {

                keyL = ''
            }
        }
        if ($(this).parent().attr('name')) {

        } else {
            keyImgL = $('li[name=' + keyL + ']').find('img').attr('id');
            keyL = '';
            //          
            //          
            while (keyL == '') {
                keyImgL--;
                //               console.log(keyL)
                //               console.log($('#carousel_ul li ').find('img[id=1]').parent().attr('name'))
                keyL = $('#carousel_ul li ').find('img[id=' + keyImgL + ']').parent().attr('name')
                if (keyImgL == '0') {
                    keyImgL = lastImgId
                }
                if (keyL) {

                } else {

                    keyL = ''
                }
            }
        }


        $('.imgDivR').html('<img src="' + $('#carousel_ul li ').find('img[id=' + keyImgR + ']').attr('src') + '" name="' + keyImgR + '" style="width:76px;height:100px">')

        $('.imgDiv').html('<img src="' + $('#carousel_ul li ').find('img[id=' + keyImgL + ']').attr('src') + '" name="' + keyImgL + '" style="width:76px;height:100px">')

        $('.rotatorBg img').attr('src', $(this).attr('src')).css({
            'max-width': '625px',
            'height': '507px'
        })
    })
})

//opasity left right nav button
$(function () {
    $('.leftMenuArrow,.rightMenuArrow').hover(function () {
        $(this).css('opacity', '1')
    }, function () {
        $(this).css('opacity', '0.7')

    })
})


//MAIN PAGE MAIN PAGE MAIN PAGE MAIN PAGEMAIN PAGE MAIN PAGEMAIN PAGE MAIN PAGEMAIN PAGE MAIN PAGEMAIN PAGE MAIN PAGEMAIN PAGE MAIN PAGE //
//right hover menu
$(function () {
    $('.customMenu').hover(function () {
        $(this).css({
            'backgroundColor': '#666666'

        })
        $(this).children('p.custommenuText').css('color', '#fff')
        $(this).children('p').find('img').attr('src', '/image/customArrovSel.png')
        $(this).children('div').show()
    }, function () {
        $(this).children('p.custommenuText').removeAttr('style')
        $(this).removeAttr('style')
        $(this).children('p').find('img').attr('src', '/image/customArrov.png')
        $(this).children('div').hide()
    })
})

//client hover
$(function () {
    $('.customerLogos').hover(function () {
        $(this).css('color', '#4e9000')
    }, function () {
        $(this).css('color', '#333333')
    })
})
//main footer hover

$(function () {
    $('div[class*=mainFooter]').hover(function () {
        $(this).css({
            'border': '1px solid #e7e7e7',
            'boxShadow': '2px 2px 4px -1px #000000'
        })
    }, function () {
        $(this).removeAttr('style')
    })
})

//meintext hover
$(function () {
    $('.main1Text a').click(function (e) {
        e.preventDefault(this)
    })

    $('.main1Text a').hover(function (e) {
        $(this).css('color', '#5a9711')
    }, function () {
        $(this).css('color', '#333333')
    })
})
//hover button main 
$(function () {
    $('input[class*=MainButton],span.MainButtonthird').hover(function () {

        $(this).css('background', 'url("/image/buttonBgSel.png")')
    }, function () {
        $(this).css('background', 'url("/image/buttonBg.png")')
    }).css('cursor', 'pointer')
})
//email hover
$(function () {
    $('.emailMain').hover(function () {
        $(this).css('color', '#91db47')
    }, function () {
        $(this).removeAttr('style')
    })
})

//rotator click change
$(function () {
    $('.rotatorbutton ').first().css('backgroundColor', '#0091ed')

    $('.rotatorbutton').click(function (e) {
        //        console.log(e)
        $('.rotatorbutton').each(function () {
            $(this).removeAttr('style')
        })
        $(this).css('backgroundColor', '#0091ed')
        $('div[id*=sector]').each(function () {
            $(this).hide()
        })
        divName = $(this).attr('name')
        $('#' + divName + '').delay(100).fadeIn(1000)
        if (e.clientX == true) {
            alert('false')
        }
    })
})
var sbros = 2;
//rotator change
$(function () {

    var
        interval = setInterval(rotator, 5000);
    var rotatorFirst = $('div[name*=sector]').first()
    var rotatorZminna = $('div[name*=sector][style==""]')
    var rotatorLast = $('div[name*=sector]').last().attr('name')

    function rotator() {
        if ($('div[name*=sector][style==""]').attr('name') == rotatorLast) {
            rotatorZminna = $('div[name*=sector][style==""]')
            rotatorZminna = rotatorFirst
            rotatorZminna.trigger('click')


        } else {

            rotatorZminna = $('div[name*=sector][style==""]').next()
            $('div[name*=sector][style==""]').next().trigger('click')
        }
    }

    $('div[id*=sector]').mouseenter(function () {
        clearInterval(interval);
    })
    $('div[id*=sector]').mouseleave(function () {
        interval = setInterval(rotator, 5000);
    })
//    function countSecun(){
//                i++;
//                if(i=='10'){
//                                    clearInterval(interval)  
//                    interval=  setInterval(rotator, 5000); 
//                    clearInterval(secCount)
//                }
//            }  
//            
//    $('div[name*=sector]').click(function(e){
//        if(e.originalEvent){
//            clearInterval(interval)
//            i=0;
//            secCount= setInterval(countSecun,1000)
//            
//        }
//         
//          
//          
//          
//          
//    //          function countSec(){
//    //           interval = setInterval(rotator, 5000);    
//    //          }
//    //           clearInterval(countSec)   
//         
//    })

})


//custom print li hover
$(function () {
    $('.custprintNav li,.ResNav li').hover(function () {
        $(this).css('color', '#91db47')
    }, function () {
        $(this).removeAttr('style')
    })
//    $('.ContactNavBord li').hover(function(){
// $(this).find('span[class*=ContactTitle]').each(function(){
//     $(this).css('color','#ffc000')
// })
// $(this).find()
//},function(){
//    
//})
//$('.ContactTitleFirst,.ContactTitle').hover(function(){
//$(this).css('color','#ffc000') 
//},function(){
//    $(this).removeAttr('style') 
//})
})


//custom print button click
$(function () {
    $('.customPrintButton').click(function () {

        if ($(this).is('.clicked')) {
            $(".customPrintSelect").hide()
            $(this).removeClass('clicked')
            $('.plus').removeAttr('style')
            $('.plus').find('img').attr('src', '/image/ButtonPlus.png')
            $('.buttonText').removeAttr('style')
        } else {
            $('.buttonText').css('borderRadius', '0px 8px 0 0')
            $('.plus').css('borderRadius', '8px 0 0 0')
            $('.plus').find('img').attr('src', '/image/ButtonMinus.png')
            $(this).addClass('clicked')
            $(".customPrintSelect").show()
        }
    })
    $('.customPrintButton').mouseleave(function () {
        $('.customPrintButton').trigger('click');
    })
})

$(function () {
    landImgFirst = $('.landingLeft span[class*=landingImg]').first()
    landImgChange = $('.landingLeft span[class*=landingImg]').first()
    landImglast = $('.landingLeft span[class*=landingImg]').last()
    landImgChange.addClass('Landchousen');
    var landpage = setInterval(landing, 4000);

    function landing() {
        $('.landingLeft span[class*=Landchousen]').each(function () {
            $(this).fadeOut(1500)
            $(this).removeClass('Landchousen')
        })
        if (landImgChange.attr('id') == landImglast.attr('id')) {

            landImgChange = landImgFirst
        } else {
            landImgChange = landImgChange.next()
        }
        landImgChange.addClass('Landchousen')
        landImgChange.fadeIn(1500)
    }
})
$(function () {
    $(".various").fancybox({
        maxWidth: 690,
        height: 820,
        fitToView: false,
        width: '70%',

        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none'
    });
})