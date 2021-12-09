$(document).ready(function () {
    const hotelSlider = new Swiper('.hotel-slider', {
    // Optional parameters
    loop: true,

    keyboard: {
      enabled: true,
      onlyInViewport: false,
    },

    // Navigation arrows
    navigation: {
      nextEl: '.hotel-slider__button--next',
      prevEl: '.hotel-slider__button--prev',
    },
    effect: "coverflow"
  });

  const reviewsSlider = new Swiper('.reviews-slider', {
    // Optional parameters
    loop: true,
    autoHeight: false,
    keyboard: {
      enabled: true,
      onlyInViewport: false,
    },

    // Navigation arrows
    navigation: {
      nextEl: '.reviews-slider__button--next',
      prevEl: '.reviews-slider__button--prev',
    },
  });

  // mobile menu
  var menuButton = $(".menu-button");
  menuButton.on('click', function () {
    $(".navbar-bottom").toggleClass("navbar-bottom--visible");
  });

  // modal window
  var modalButton = $("[data-toggle=modal]");
  var closeModalButton = $(".modal__close");
  modalButton.on("click", openModal);
  closeModalButton.on("click", closeModal);
  
  function openModal() {
    var modalOverlay = $(".modal__overlay");
    var modalDialog = $(".modal__dialog");
    var overflowHidden = $("body");
    modalOverlay.addClass("modal__overlay--visible");
    modalDialog.addClass("modal__dialog--visible");
    overflowHidden.addClass("lock");
  };

  function closeModal(event) {
    event.preventDefault();
    var modalOverlay = $(".modal__overlay");
    var modalDialog = $(".modal__dialog");
    var overflowHidden = $("body");
    modalOverlay.removeClass("modal__overlay--visible");
    modalDialog.removeClass("modal__dialog--visible");
    overflowHidden.removeClass("lock");
  };
  
  // Закрытие окна по кнопке ESC
  $(document).keydown(function (e) { 
    if (e.keyCode == 27) {
      var modalOverlay = $(".modal__overlay");
      var modalDialog = $(".modal__dialog");
      var overflowHidden = $("body");
      modalOverlay.removeClass("modal__overlay--visible");
      modalDialog.removeClass("modal__dialog--visible");
      overflowHidden.removeClass("lock");
    }
  });

  // Валидация форм
  $(".form").each(function() {
    $(this).validate({
      errorClass: "invalid",
      messages: {
        name: {
          required: "Please specify your name",
          minlength: "Your Name must be at least 2 letters long"
        },
        email: {
          required: "We need your email address to contact you",
          email: "Your email address must be in the format of name@domain.com"
        },
        phone: {
          required: "Phone is required",
          minlength: "Your phone number must be in the format of +7 (xxx) xxx-xx-xx"
        },
      }
    });
  });

  $('.phone').mask('+7 (999) 999-99-99');

  AOS.init({ disable: function() {
     var maxWidth = 993; 
     return window.innerWidth < maxWidth; } 
  });
});

