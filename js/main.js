jQuery(function($) {

    selectDefault()

    $(document).ready(function () {
    $('.animated-line-block__arrow').click(function() {
        let parent = $(this).closest('.animated-line-block');
        let next = $(parent).next();
        $('html, body').animate({
        scrollTop: $(next).offset().top
        }, 1000);
    });
    $('.contact-gallery__link').click(function(e) {
    	let id = $(this).attr('href');
        if ($(id).length > 0) {
        	$('html, body').animate({
            scrollTop: $(id).offset().top 
            }, 1000);
            console.log($(id));
        }
    });
        if($('.animated-line').length) {
            const animation = anime({
                targets: '.animated-line  path',
                strokeDashoffset: ['', anime.setDashoffset],
                easing: 'easeInOutSine',
                duration: 3000,
                delay: function(el, i) { return i * 250 },
                direction: 'reverse',
                // reversed: true,
                // loop: true
            });

            // animation.seek(2500);
            animation.play();
        }

        if($('.faq-accordeon')) {
            $('.faq-accordeon').on('click', '.faq-accordeon__question', (event) => {
                const $item = $(event.target).closest('.faq-accordeon__card');

                $('.faq-accordeon__card.is-active .faq-accordeon__answer').slideUp();

                if($item.hasClass('is-active')) {
                    $item.removeClass('is-active');
                    return;
                } else {
                    $('.faq-accordeon__card').removeClass('is-active');
                    $item.find('.faq-accordeon__answer').slideDown();
                    $item.addClass('is-active');
                }
            });
        }

        $(".our-team-card__arrow").on("click", function () {
            $(this).closest(".our-team-card").find(".teammate-popup-wrap").addClass('active');
            $('body').addClass('blocked');
        });

        $(".teammate-popup__close-js").on("click", function () {
            $(".teammate-popup-wrap").removeClass('active');
            $('body').removeClass('blocked');
        });

        $(document).click(function(event) {
            if (!$(event.target).closest(".our-team-card__arrow, .teammate-popup").length) {
                $("body").find(".teammate-popup-wrap").removeClass('active');
                $('body').removeClass('blocked');
            }
        });

        $('a[href="#room_view"]').click(function (e) {
            e.preventDefault();
            $('html').animate({scrollTop: $('.product__compare').offset().top - 70}, 400, 'linear');
        })

        $('.mobile-menu-button').on('click', function (e) {
            e.preventDefault();
            $(this).addClass('hidden');
            $('.mobile-search-button').addClass('hidden');
            $('.mobile-menu-close').removeClass('hidden');
            $('.mobile-cart-button').removeClass('hidden');
            $('.header__mobile-menu').addClass('opened');
            $('body').addClass('no-scroll');
        })

        $('.mobile-menu-close').on('click', function (e) {
            e.preventDefault();
            $(this).addClass('hidden');
            $('.mobile-menu-button').removeClass('hidden');
            $('.mobile-search-button').removeClass('hidden');
            $('.mobile-cart-button').addClass('hidden');
            $('.header__mobile-menu').removeClass('opened');
            $('body').removeClass('no-scroll');
        })

        $('.mobile-search-button').on('click', function (e) {
            e.preventDefault();
            $(this).addClass('hidden');
            $('.mobile-search-close').removeClass('hidden');
            $('.mobile-menu-button').addClass('hidden');
            $('.header__mobile-search').addClass('opened');
            $('body').addClass('no-scroll');
        })

        $('.mobile-search-close').on('click', function (e) {
            e.preventDefault();
            $(this).addClass('hidden');
            $('.mobile-search-button').removeClass('hidden');
            $('.mobile-menu-button').removeClass('hidden');
            $('.header__mobile-search').removeClass('opened');
            $('body').removeClass('no-scroll');
        })


        const nextSliderArrow = '<svg class="slider-button slider-button-next" width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
        '<circle r="22.5" transform="matrix(-1 0 0 1 22.5 22.5)" fill="#EAEBEC"/>\n' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M18.9396 15.0607C18.3538 15.6465 18.3538 16.5962 18.9396 17.182L25.8182 24.0607C26.404 24.6465 27.3538 24.6465 27.9396 24.0607C28.5254 23.4749 28.5254 22.5251 27.9396 21.9394L21.0609 15.0607C20.4751 14.4749 19.5254 14.4749 18.9396 15.0607Z" fill="#3A56A5"/>\n' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M18.9396 30.9393C18.3538 30.3535 18.3538 29.4038 18.9396 28.818L25.8182 21.9393C26.404 21.3535 27.3538 21.3535 27.9396 21.9393C28.5254 22.5251 28.5254 23.4749 27.9396 24.0606L21.0609 30.9393C20.4751 31.5251 19.5254 31.5251 18.9396 30.9393Z" fill="#3A56A5"/>\n' +
        '</svg>\n';
        const prevSliderArrow = '<svg class="slider-button slider-button-prev" width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
        '<circle cx="22.5" cy="22.5" r="22.5" fill="#EAEBEC"/>\n' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M26.0604 15.0607C26.6462 15.6465 26.6462 16.5962 26.0604 17.182L19.1818 24.0607C18.596 24.6465 17.6462 24.6465 17.0604 24.0607C16.4746 23.4749 16.4746 22.5251 17.0604 21.9394L23.9391 15.0607C24.5249 14.4749 25.4746 14.4749 26.0604 15.0607Z" fill="#3A56A5"/>\n' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M26.0604 30.9393C26.6462 30.3535 26.6462 29.4038 26.0604 28.818L19.1818 21.9393C18.596 21.3535 17.6462 21.3535 17.0604 21.9393C16.4746 22.5251 16.4746 23.4749 17.0604 24.0606L23.9391 30.9393C24.5249 31.5251 25.4746 31.5251 26.0604 30.9393Z" fill="#3A56A5"/>\n' +
        '</svg>\n';

        $('.related-posts__list--artworks').slick({
            slidesToScroll: 3,
            slidesToShow: 3,
            infinite: false,
//             variableWidth: true,
            prevArrow: prevSliderArrow,
            nextArrow: nextSliderArrow,
            responsive: [
             {
             breakpoint: 600,
             settings: {
                 slidesToShow: 2,
                 slidesToScroll: 2
                 }
             },
             {
             breakpoint: 480,
             settings: {
                 slidesToShow: 1,
                 slidesToScroll: 1
                 }
             }
            ]
        })

        function relatedArtistsArrowPosition(){
            const arrow = $('.related-posts__list--artworks .slider-button');
            const arrowHeight = parseInt(arrow.height());
            const wrapper = $('.related-posts__list--artworks .product-card__wrapper');
            const wrapperHeight  = (parseInt(wrapper.height()))/2;
            arrow.css('top', wrapperHeight + arrowHeight/2 + 'px');
        }
        relatedArtistsArrowPosition();

        $(window).on('load resize orientationchange', function() {
            $('.related-posts__list--artists, .latest-news__block').each(function(){
                var $carousel = $(this);
                /* Initializes a slick carousel only on mobile screens */
                // slick on mobile
                if ($(window).width() > 768) {
                    if ($carousel.hasClass('slick-initialized')) {
                        $carousel.slick('unslick');
                    }
                }
                else{
                    if (!$carousel.hasClass('slick-initialized')) {
                        $carousel.slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            mobileFirst: true,
                            infinite: false,
                            prevArrow: prevSliderArrow,
                            nextArrow: nextSliderArrow,
                        });
                    }
                }
            });

            relatedArtistsArrowPosition();
        });

        $('.featured-artists__block').slick({
            slidesToScroll: 1,
            slidesToShow: 3,
            prevArrow: prevSliderArrow,
            nextArrow: nextSliderArrow,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ]
        })

        $('.video-tutorials__block').slick({
            slidesToScroll: 1,
            slidesToShow: 3,
//             variableWidth: true,
//             centerMode: true,
            prevArrow: prevSliderArrow,
            nextArrow: nextSliderArrow,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
//                         variableWidth: false,
//                         centerMode: false,
                    },
                },
            ]
        })

        $('.cta-carousel-slides').slick({
            slidesToScroll: 1,
            slidesToShow: 1,
			 autoplay: true,
			autoplaySpeed: 3000,
            prevArrow: prevSliderArrow,
            nextArrow: nextSliderArrow,
        });
        
        $('.video-tutorials__image').on('click', function () {
            $('.video-tutorials-popup').addClass('active');
            $('.video-tutorials-popup iframe').attr('src', $(this).attr('data-src'));
        });

        $(".video-tutorials-popup__close").on("click", function () {
            $(".video-tutorials-popup").removeClass('active');
            $('.video-tutorials-popup iframe').attr('src', '');
        });

        $(document).click(function(event) {
            if (!$(event.target).closest(".video-tutorials-popup__iframe, .video-tutorials__image").length) {
                $("body").find(".video-tutorials-popup").removeClass('active');
                $('.video-tutorials-popup iframe').attr('src', '');
            }
        });

        if($('body').hasClass('page-template-template-calendar')) {
            $('.blog-page__calendar-filters-mobile__icon.filters').click(function (e) {
                $('.blog-page__calendar-filters-mobile__dropdown.filters-dropdown').toggleClass('open')
            })

            $('.blog-page__calendar-filters-mobile__icon.view').click(function (e) {
                $('.blog-page__calendar-filters-mobile__dropdown.view-dropdown').toggleClass('open');
            })

            $(document).mouseup( function (e) {
                var div = $('.blog-page__calendar-filters-mobile__dropdown');
                if (!div.is(e.target)
                    && div.has(e.target).length === 0) {
                    div.removeClass('open');
                }
            })
        }

        $('.back-link__link').on('click', function(e) {
            e.preventDefault();
            window.history.back();
        });

        if($('body').hasClass('page-template-template-checkout')) {
            let messages = {
                billing_first_name: 'First Name is required field',
                billing_last_name: 'Last Name is required field',
                billing_phone: 'Phone is required field',
                billing_email: 'Email is required field',
                billing_city: 'City is required field',
                billing_postcode: 'Postcode is required field',
                shipping_city: 'City is required field',
                shipping_postcode: 'Postcode is required field',
                billing_address_1: '',
                billing_address_2: '',
            }

            $('select').select2({
                minimumResultsForSearch: Infinity,
                dropdownParent: $('.checkout-page__select-dropdown'),
                dropdownPosition: 'below',
            });

            $('.place-order__cart-link').click(function (e) {
                e.preventDefault();
                $('.cart-wrapper').addClass('open');
                $('body').addClass('no-scroll');
            })

            if($('.change-billing-address input:checked').val() === 'same') {
                $('#billing_address_1').val($('#shipping_address_1').val())
                $('#billing_address_2').val($('#shipping_address_2').val())
                $('#billing_city').val($('#shipping_city').val())
                $('#billing_postcode').val($('#shipping_postcode').val())
                $('.change-billing-address + .woocommerce-billing-fields__field-wrapper').slideUp(400)
            }

            if($('.change-billing-address input:checked').val() === 'new') {
                $('#billing_address_1').val('')
                $('#billing_address_2').val('')
                $('#billing_city').val('')
                $('#billing_postcode').val('')
                $('.change-billing-address + .woocommerce-billing-fields__field-wrapper').slideDown(400)
            }

            $('.change-billing-address input').on('change', function () {
                if($(this).val() === 'same') {
                    $('#billing_address_1').val($('#shipping_address_1').val())
                    $('#billing_address_2').val($('#shipping_address_2').val())
                    $('#billing_city').val($('#shipping_city').val())
                    $('#billing_postcode').val($('#shipping_postcode').val())
                    $('.change-billing-address + .woocommerce-billing-fields__field-wrapper').slideUp(400)
                }

                if($(this).val() === 'new') {
                    $('#billing_address_1').val('')
                    $('#billing_address_2').val('')
                    $('#billing_city').val('')
                    $('#billing_postcode').val('')
                    $('.change-billing-address + .woocommerce-billing-fields__field-wrapper').slideDown(400)
                }
            })

            $(document).ajaxSuccess(function ( event, xhr, settings ) {
                if(settings.url === '/?wc-ajax=checkout' && xhr.responseJSON.result === 'failure') {
                    let $message = xhr.responseJSON.messages;
                    let $fieldList = $($message).find('li');
                    $('.validation-message').remove()
                    $('input').removeClass('invalid')
                    $fieldList.each((key, mess) => {
                        let $valMess = '<sapn class="validation-message">'+messages[$(mess).attr('data-id')]+'</sapn>'
                        $('input[name="'+$(mess).attr('data-id')+'"]').after($valMess)
                        $('input[name="'+$(mess).attr('data-id')+'"]').addClass('invalid')
                    })
                }

                if(settings.url === '/?wc-ajax=update_order_review') {
                    $('.woocommerce-remove-coupon').empty().append('-')
                }
            })
        }

        if($('body').hasClass('post-type-archive-product')) {

            reloadArtworks()
            if($('.style-dropdown__styles input:checked + label').text()) {
                $('.products-section__style-title').text($('.style-dropdown__styles input:checked + label').text())
            } else {
                $('.products-section__style-title').text($('.products-section__style-title').attr('data-default'))
            }

            $('.products-section__select').select2({
                minimumResultsForSearch: Infinity,
                dropdownParent: $('.products-section__select-dropdown'),
                dropdownPosition: 'below',
            });
			$('.products-section__select').on("select2:selecting", function(e) { 
            // what you would like to happen
            	if (!$('.products-section__filtering').hasClass('active'))
                $('.products-section__filtering').addClass('active');
            });
            function clearFilters() {
              $('.products-section__filtering').removeClass('active')
            let category = $('.products-section__select.category').val('');
            let style = $('.style-dropdown__styles input:checked').val('');
            let tech = $('.products-section__select.technique').val('');
            let format = $('.products-section__select.format').val('');
            let size = $('.products-section__select.size').val('');
            let minPrice = $('.products-section__price-filter #priceRangeMin').val(''); 
            let maxPrice = $('.products-section__price-filter #priceRangeMax').val('');
            $('.products-section__select').each(function() {
            $(this).val('all').trigger('change');
            });
            $('.products-section__style-title').text('Style');
            reloadArtworks();
            }
            $('.clear-filter__btn').on('click', function() {
            clearFilters();
            
            });
            $(function() {
                let minPrice = parseInt($('.products-section__price-filter .products-section__dropdown').attr('data-min-price'));
                let maxPrice = parseInt($('.products-section__price-filter .products-section__dropdown').attr('data-max-price'));
                $("#price-range").slider(
                    {range: true,
                        min: minPrice,
                        max: maxPrice,
                        values: [minPrice, maxPrice],
                        slide: function(event, ui) {
                            $("#priceRangeMin").val(ui.values[0]);
                            $("#priceRangeMax").val(ui.values[1]);
                        }
                    }
                );
                $("#priceRangeMin").val($("#price-range").slider("values", 0));
                $("#priceRangeMax").val($("#price-range").slider("values", 1));
            });

            $("#priceRangeMin" ).on('change', function () {
                $("#price-range").slider('values', 0, $("#priceRangeMin").val())
            })

            $("#priceRangeMax" ).on('change', function () {
                $("#price-range").slider('values', 1, $("#priceRangeMax").val())
            })

            $('.products-section__price-title').click(function () {
                let wrapper = $(this).closest('.products-section__price-filter');

                if(wrapper.hasClass('open')) {
                    wrapper.removeClass('open')
                    wrapper.removeClass('margin')
                } else {
                    wrapper.addClass('open')
                    if($(window).width() <= 991) {
                        wrapper.addClass('margin')
                    }
                }
            })

            $('.products-section__style-title').click(function () {
                let wrapper = $(this).closest('.products-section__style-filter');

                if(wrapper.hasClass('open')) {
                    wrapper.removeClass('open')
                    wrapper.removeAttr('style')
                } else {
                    wrapper.addClass('open')
                    if($(window).width() <= 991) {
                        setTimeout(function () {
                            let marg = $('.style-dropdown').height() + 15;
                            wrapper.attr('style', 'margin-bottom: ' + marg + 'px; transition: all 0.1s')
                        }, 50)
                    }
                }
            })

            $(document).click(function (e) {
                var div = $('.products-section__price-filter');
                if (!div.is(e.target)
                    && div.has(e.target).length === 0) {
                    div.removeClass('open');
                }
            })

            $(document).click(function (e) {
                var div = $('.products-section__style-filter');
                if (!div.is(e.target)
                    && div.has(e.target).length === 0) {
                    div.removeClass('open');
                }
            })

            if($(window).width() <= 991) {
                $('.products-section__select').on('select2:open', function (e) {
                    let select = $(this).next()
                    $('.products-section__style-filter').removeAttr('style');
                    $('.products-section__price-filter').removeClass('margin');
                    setTimeout(function () {
                        select.attr('style', 'margin-bottom: ' + $('.products-section__select-dropdown .select2-dropdown').height() + 'px; transition: all 0.1s')
                    }, 50)

                })

                $('.products-section__select').on('select2:close', function (e) {
                    let select = $(this).next()
                    select.removeAttr('style')
                })
            }

            $('.products-section__select').on('select2:select', function (e) {
                if($(this).hasClass('category')) {
                    $('.style-dropdown__styles input').prop('checked', false);
                    $('.products-section__style-title').text($('.products-section__style-title').attr('data-default'))
                    reloadArtworks();
                } else {
                    reloadArtworks();
                }
            })

            $('.style-dropdown__styles input').on('change', function (e) {
            if (!$('.products-section__filtering').hasClass('active'))
                $('.products-section__filtering').addClass('active');
                $('.products-section__select.category').val($('.style-dropdown__styles input:checked').attr('data-parent')).trigger('change')
                $('.products-section__style-title').text($('.style-dropdown__styles input:checked + label').text())
                reloadArtworks();
            })

            $("#price-range").on('slidechange', function () {
                reloadArtworks();
            })

            $('.products-section__loadMore').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: ajaxObject.ajaxurl,
                    type: 'POST',
                    data: {
                        'action': 'loadMoreArtworks',
                        'posts': ajaxObject.posts,
                        'current_page': ajaxObject.current_page,
                    },
                    beforeSend: function () {
                        $('.loader-section').addClass('shown');
                        $('.products-section__loadMore a').addClass('hidden');
                    },
                    success: function (responce) {
                        let decode = $.parseJSON(responce);
                        ajaxObject.current_page++;
                        $('.loader-section').before(decode.output)
                        if(ajaxObject.current_page < ajaxObject.max_page) {
                            $('.products-section__loadMore a').removeClass('hidden');
                        }
                        $('.loader-section').removeClass('shown');
                    }
                })
            })
        }

        if($('body').hasClass('post-type-archive-artists')) {
            reloadArtists()
            $('.filtering-item a').click(function (e) {
                e.preventDefault();
               	if (!$('.blog-page__filter').hasClass('active'))
                	$('.blog-page__filter').addClass('active');
                $('.filtering-item').removeClass('active')
                $(this).parent().addClass('active')

                reloadArtists()
            })
$('.clear-filter').click(function () {
$('.blog-page__filter').removeClass('active');
$('.filtering-item').removeClass('active');
reloadArtists()
});
            $('.blog-page__loadMore').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: ajaxObject.ajaxurl,
                    type: 'POST',
                    data: {
                        'action': 'loadMoreArtists',
                        'posts': ajaxObject.posts,
                        'current_page': ajaxObject.current_page,
                    },
                    beforeSend: function () {
                        $('.loader-section').addClass('shown');
                        $('.blog-page__loadMore a').addClass('hidden');
                    },
                    success: function (responce) {
                        let decode = $.parseJSON(responce);
                        ajaxObject.current_page++;
                        $('.loader-section').before(decode.output)
                        if(ajaxObject.current_page < ajaxObject.max_page) {
                            $('.blog-page__loadMore a').removeClass('hidden');
                        }
                        $('.loader-section').removeClass('shown');
                    }
                })
            })
        }

        if($('body').hasClass('page-template-template-blog')) {
            $.ajax({
                url: ajaxObject.ajaxurl,
                type: 'POST',
                data: {
                    'action': 'loadPosts',
                },
                beforeSend: function () {
                    $('.loader-section').addClass('shown');
                    $('.blog-page__loadMore a').addClass('hidden');
                },
                success: function (responce) {
                    let decode = $.parseJSON(responce);
                    ajaxObject.current_page = 1;
                    ajaxObject.posts = decode.posts;
                    ajaxObject.max_page = decode.max_page;
                    $('.loader-section').before(decode.output)
                    $('.loader-section').removeClass('shown');
                    if(ajaxObject.current_page < ajaxObject.max_page) {
                        $('.blog-page__loadMore a').removeClass('hidden');
                    }
                }
            })
            $('.blog-page__loadMore').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: ajaxObject.ajaxurl,
                    type: 'POST',
                    data: {
                        'action': 'loadMorePosts',
                        'posts': ajaxObject.posts,
                        'current_page': ajaxObject.current_page,
                    },
                    beforeSend: function () {
                        $('.loader-section').addClass('shown');
                        $('.blog-page__loadMore a').addClass('hidden');
                    },
                    success: function (responce) {
                        let decode = $.parseJSON(responce);
                        ajaxObject.current_page++;
                        $('.loader-section').before(decode.output)
                        if(ajaxObject.current_page < ajaxObject.max_page) {
                            $('.blog-page__loadMore a').removeClass('hidden');
                        }
                        $('.loader-section').removeClass('shown');
                    }
                })
            })
        }

        if($('body').hasClass('category') || $('body').hasClass('tag')) {
            $('.blog-page__loadMore').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: ajaxObject.ajaxurl,
                    type: 'POST',
                    data: {
                        'action': 'loadMorePosts',
                        'posts': ajaxObject.posts,
                        'current_page': ajaxObject.current_page,
                    },
                    beforeSend: function () {
                        $('.loader-section').addClass('shown');
                        $('.blog-page__loadMore a').addClass('hidden');
                    },
                    success: function (responce) {
                        let decode = $.parseJSON(responce);
                        ajaxObject.current_page++;
                        $('.loader-section').before(decode.output)
                        if(ajaxObject.current_page < ajaxObject.max_page) {
                            $('.blog-page__loadMore a').removeClass('hidden');
                        }
                        $('.loader-section').removeClass('shown');
                    }
                })
            })
        }

        if($('body').hasClass('single-product')) {
//             $(document).ajaxSuccess(function (event, jqXHR, ajaxOptions){
//                 if(ajaxOptions.url === '/?wc-ajax=get_refreshed_fragments') {
					if (localStorage.getItem('showCart') == 'true') {
						$('.cart-wrapper').addClass('open');
						$('body').addClass('no-scroll');	
						localStorage.removeItem('showCart');
					}
//                 }
//             })
        }
		$('.single-product .single_add_to_cart_button').on('click', function() {
			localStorage.setItem('showCart', true);
		});
        if($('body').hasClass('page-template-template-calendar')) {
            $('input[type="radio"]').on('change', function () {
                reloadCalendarPage()
            })
        }

        $('.header__cart, .mobile-cart-button').click(function (e) {
            e.preventDefault()
            $('.cart-wrapper').addClass('open');
            $('body').addClass('no-scroll');
        })

        $('.select2-selection__arrow').append('<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
            '<circle r="12" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 12 12)" fill="#EAEBEC"/>\n' +
            '<path fill-rule="evenodd" clip-rule="evenodd" d="M15.968 10.098C15.6556 9.78558 15.1491 9.78558 14.8367 10.098L11.168 13.7666C10.8556 14.0791 10.8556 14.5856 11.168 14.898C11.4804 15.2104 11.987 15.2104 12.2994 14.898L15.968 11.2294C16.2804 10.917 16.2804 10.4104 15.968 10.098Z" fill="#3A56A5"/>\n' +
            '<path fill-rule="evenodd" clip-rule="evenodd" d="M7.49926 10.098C7.81168 9.78558 8.31821 9.78558 8.63063 10.098L12.2993 13.7666C12.6117 14.0791 12.6117 14.5856 12.2993 14.898C11.9868 15.2104 11.4803 15.2104 11.1679 14.898L7.49926 11.2294C7.18684 10.917 7.18684 10.4104 7.49926 10.098Z" fill="#3A56A5"/>\n' +
            '</svg>\n')
		
		 lazy_load_script();
    })

    function reloadCalendarPage() {
        let view;
        let cat;
        let location;
        if($(window).width() >= 798) {
            view = $('input[name="view-filter"]:checked').val() ? $('input[name="view-filter"]:checked').val() : 'month';
            cat = $('input[name="category-filter"]:checked').val() ? $('input[name="category-filter"]:checked').val() : 'all';
            location = $('input[name="location-filter"]:checked').val() ? $('input[name="location-filter"]:checked').val() : 'all';
        } else {
            view = $('input[name="view-filter-mobile"]:checked').val() ? $('input[name="view-filter-mobile"]:checked').val() : 'month';
            cat = $('input[name="category-filter-mobile"]:checked').val() ? $('input[name="category-filter-mobile"]:checked').val() : 'all';
            location = $('input[name="location-filter-mobile"]:checked').val() ? $('input[name="location-filter-mobile"]:checked').val() : 'all';
        }
        window.location.href = window.location.origin+window.location.pathname+'?view='+view+'&cat='+cat+'&location='+location;
    }

    function reloadArtworks() {
        let category = $('.products-section__select.category').val() ? $('.products-section__select.category').val() : 'all';
        let style = $('.style-dropdown__styles input:checked').val() ? $('.style-dropdown__styles input:checked').val() : 'all';
        let tech = $('.products-section__select.technique').val() ? $('.products-section__select.technique').val() : 'all';
        let format = $('.products-section__select.format').val() ? $('.products-section__select.format').val() : 'all';
        let size = $('.products-section__select.size').val() ? $('.products-section__select.size').val() : 'all';
        let minPrice = $('.products-section__price-filter #priceRangeMin').val() ? $('.products-section__price-filter #priceRangeMin').val() : $('.products-section__price-filter .products-section__dropdown').attr('data-min-price')
        let maxPrice = $('.products-section__price-filter #priceRangeMax').val() ? $('.products-section__price-filter #priceRangeMax').val() : $('.products-section__price-filter .products-section__dropdown').attr('data-max-price')

        window.history.pushState('','',window.location.origin+window.location.pathname+'?cat='+category+'&style='+style+'&tech='+tech+'&format='+format+'&size='+size)
        console.log('reload artworks');
        $.ajax({
            url: ajaxObject.ajaxurl,
            type: 'POST',
            data: {
                'action': 'reloadArtworks',
                'category': category,
                'style': style,
                'technique': tech,
                'format': format,
                'size': size,
                'minPrice': minPrice,
                'maxPrice': maxPrice,
            },
            beforeSend: function () {
                $('.loader-section').addClass('shown');
                $('.products-section__loadMore a').addClass('hidden');
                $('.products .product').remove();
            },
            success: function (responce) {
                let decode = $.parseJSON(responce);
                ajaxObject.current_page = 1;
                ajaxObject.posts = decode.posts;
                ajaxObject.max_page = decode.max_page;
                $('.loader-section').before(decode.output)
                $('.loader-section').removeClass('shown');
                if(ajaxObject.current_page < ajaxObject.max_page) {
                    $('.products-section__loadMore a').removeClass('hidden');
                }
				
				//lazy_load_script();
            }
        })
    }

    function reloadArtists() {
        let filterItems = $('.filtering-item.active a');
        let filters = '';
        filterItems.each(function (index, item) {
            if(index === 0) {
                filters += $(item).attr('data-item');
            } else {
                filters += ', '+$(item).attr('data-item');
            }
        })

        $.ajax({
            url: ajaxObject.ajaxurl,
            type: 'POST',
            data: {
                'action': 'reloadArtists',
                'categories': filters,
            },
            beforeSend: function () {
                $('.loader-section').addClass('shown');
                $('.blog-page__loadMore a').addClass('hidden');
                $('.blog-page__post-list .artist-card').remove();
            },
            success: function (responce) {
                let decode = $.parseJSON(responce);
                ajaxObject.current_page = 1;
                ajaxObject.posts = decode.posts;
                ajaxObject.max_page = decode.max_page;
                $('.loader-section').before(decode.output)
                $('.loader-section').removeClass('shown');
                if(ajaxObject.current_page < ajaxObject.max_page) {
                    $('.blog-page__loadMore a').removeClass('hidden');
                }
				
				lazy_load_script();
            }
        })
    }

    function selectDefault() {
        var Defaults = $.fn.select2.amd.require('select2/defaults');

        $.extend(Defaults.defaults, {
            dropdownPosition: 'auto'
        });

        var AttachBody = $.fn.select2.amd.require('select2/dropdown/attachBody');

        var _positionDropdown = AttachBody.prototype._positionDropdown;

        AttachBody.prototype._positionDropdown = function() {

            var $window = $(window);

            var isCurrentlyAbove = this.$dropdown.hasClass('select2-dropdown--above');
            var isCurrentlyBelow = this.$dropdown.hasClass('select2-dropdown--below');

            var newDirection = null;

            var offset = this.$container.offset();

            offset.bottom = offset.top + this.$container.outerHeight(false);

            var container = {
                height: this.$container.outerHeight(false)
            };

            container.top = offset.top;
            container.bottom = offset.top + container.height;

            var dropdown = {
                height: this.$dropdown.outerHeight(false)
            };

            var viewport = {
                top: $window.scrollTop(),
                bottom: $window.scrollTop() + $window.height()
            };

            var enoughRoomAbove = viewport.top < (offset.top - dropdown.height);
            var enoughRoomBelow = viewport.bottom > (offset.bottom + dropdown.height);

            var css = {
                left: offset.left,
                top: container.bottom
            };

            // Determine what the parent element is to use for calciulating the offset
            var $offsetParent = this.$dropdownParent;

            // For statically positoned elements, we need to get the element
            // that is determining the offset
            if ($offsetParent.css('position') === 'static') {
                $offsetParent = $offsetParent.offsetParent();
            }

            var parentOffset = $offsetParent.offset();

            css.top -= parentOffset.top
            css.left -= parentOffset.left;

            var dropdownPositionOption = this.options.get('dropdownPosition');

            if (dropdownPositionOption === 'above' || dropdownPositionOption === 'below') {
                newDirection = dropdownPositionOption;
            } else {

                if (!isCurrentlyAbove && !isCurrentlyBelow) {
                    newDirection = 'below';
                }

                if (!enoughRoomBelow && enoughRoomAbove && !isCurrentlyAbove) {
                    newDirection = 'above';
                } else if (!enoughRoomAbove && enoughRoomBelow && isCurrentlyAbove) {
                    newDirection = 'below';
                }
            }
            if (newDirection == 'above' ||
                (isCurrentlyAbove && newDirection !== 'below')) {
                css.top = container.top - parentOffset.top - dropdown.height;
            }
            if (newDirection != null) {
                this.$dropdown
                    .removeClass('select2-dropdown--below select2-dropdown--above')
                    .addClass('select2-dropdown--' + newDirection);
                this.$container
                    .removeClass('select2-container--below select2-container--above')
                    .addClass('select2-container--' + newDirection);
            }
            this.$dropdownContainer.css(css);
        };
    }
  
  if (localStorage.getItem("popState") != "shown") {
    setTimeout(function () {
      $("#subscribe_popup").fadeIn(300);
      $("html, body").css({
        overflow: "hidden",
      });
    }, 3000);
    localStorage.setItem("popState", "shown");
  }
  $(".popup-close").on("click", function () { 
    $('html, body').css({
      overflow: 'auto'
    });
    $("#subscribe_popup").fadeOut(300);
  });
	
	/** image lazy loading **/
	function lazy_load_script() {
		const imgElements = document.getElementsByTagName('img');
		for (let element of imgElements) {
			let value = '';
			const parentClassName = element.parentElement.className;
			if ($(element).hasClass('no-lazyloading')) continue;
			if(element.parentElement.className !== 'cta-carousel__image' && parentClassName != 'custom-logo-link'  && parentClassName != 'product__compare-image'  && parentClassName != 'ctf-author-avatar' && element.parentElement.parentElement.parentElement.parentElement.className !== 'slick-track' && element.parentElement.parentElement.parentElement.parentElement.parentElement.className !== 'slick-track') {
				if(element.getAttribute('srcset')) {
					value = element.getAttribute('srcset');
					element.removeAttribute('srcset');
					element.setAttribute('data-srcset', value);
				}

				if(element.getAttribute('src')) {
					value = element.getAttribute('src');
					element.removeAttribute('src');
					element.setAttribute('data-src', value);
				}
			}
		}
		// Show above-the-fold images first
			showImagesOnView();
		// scroll listener
		window.addEventListener( 'scroll', showImagesOnView, false );
	}

	// Show the image if reached on viewport
	function showImagesOnView( e ) {
		let images = document.querySelectorAll('img[data-src]');

		for( let i of images ) {
			if( i.getAttribute('src') ) { continue; } // SKIP if already displayed

			// Compare the position of image and scroll
			let bounding = i.getBoundingClientRect();
			let isOnView = bounding.top >= 0 &&
				bounding.left >= 0 &&
				bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
				bounding.right <= (window.innerWidth || document.documentElement.clientWidth);

			if( isOnView ) {
				i.setAttribute( 'src', i.dataset.src );
				if( i.getAttribute('data-srcset') ) {
					i.setAttribute( 'srcset', i.dataset.srcset );
				}
			}
		}
	}
});