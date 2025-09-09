document.addEventListener("DOMContentLoaded", function () {
	
	handlePopup();
	toggleMenu();
	animationHeader();
	animationHero();
	openTabs();
	wrapTablesInDiv();
	servicesMore();
	reviewsSliderInit();
	showVideo();
	reviewsMore();
	linksMore();
	showMoreContent();
	doctorReviewsSliderInit();
	doctorPublicSliderInit();
	// upDoctor();
	accordionFunction();
});

const toggleMenu = () =>{
	const htmlElement = document.querySelector("html");
	const burgerMenu = document.querySelector(".burger");
  const navLinks = document.querySelectorAll("nav a");
	const headerBg =  document.querySelector('.header__bottom');
	burgerMenu.addEventListener("click", (event) => {
    htmlElement.classList.toggle("open");
  });

  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      htmlElement.classList.remove("open");
    });
  });
}
const animationHeader = () =>{
	let lastScrollTop = 0;

  window.addEventListener("scroll", function () {
		const headerNav = document.querySelector(".header__bottom");
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		let windowInnerWidth = window.innerWidth;
    
      if (scrollTop > lastScrollTop) {
        if (scrollTop > 100) {
          headerNav.classList.add("fixed-header-nav");
        }
      } else if (scrollTop <= 0) {
        headerNav.classList.remove("fixed-header-nav");
      }
      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    
  });
}

const handlePopup = () => {
  const html = document.documentElement;

  const openPopup = () => {
    document.querySelectorAll("[data-open]").forEach((button) => {
      button.addEventListener("click", () => {
        const popupName = button.getAttribute("data-open");
        const popupTarget = document.querySelector(`[data-popup="${popupName}"]`);

        document.querySelectorAll(".popup.open-popup").forEach((popup) => {
          popup.classList.remove("open-popup");
        });

        if (popupTarget) {
          popupTarget.classList.add("open-popup");
          html.classList.add("has-popup");

          const wrapper = popupTarget.querySelector(".popup-wrapper");
          const inner = popupTarget.querySelector(".popup__container");

          if (wrapper && inner) {
            wrapper.addEventListener("click", () => {
              popupTarget.classList.remove("open-popup");
              html.classList.remove("has-popup");
            });

            inner.addEventListener("click", (e) => e.stopPropagation());
          }
        }
      });
    });
  };

  const closePopup = () => {
    document.querySelectorAll("[data-close]").forEach((button) => {
      button.addEventListener("click", () => {
        const popup = button.closest(".popup");
        if (popup) {
          popup.classList.remove("open-popup");
        }

        const anyOpen = document.querySelector(".popup.open-popup");
        if (!anyOpen) {
          html.classList.remove("has-popup");
        }
      });
    });
  };

  openPopup();
  closePopup();
};

const accordionFunction = () => {
  const accordionItems = document.querySelectorAll(".accord-item");

  accordionItems.forEach((item) => {
		const top = item.querySelector(".accord-item-top");
		if(top){
			top.addEventListener("click", function () {
				item.classList.toggle("active");
			});
		}
    
  });
};
const animationHero = () =>{
		const detailsAnimInfo = document.querySelectorAll('.hero__info-item');
		if(detailsAnimInfo){
			const interval = 3000; 
			let currentIndex = 0;

			function detailsAnimateBlocks() {
				detailsAnimInfo.forEach((wrap, index) => {
				if (index === currentIndex) {
					wrap.classList.add('active');
				} else {
					wrap.classList.remove('active');
				}
				});
				currentIndex = (currentIndex + 1) % detailsAnimInfo.length;
				}
				detailsAnimateBlocks();
			setInterval(detailsAnimateBlocks, interval);
		}
}
const wrapTablesInDiv = () => {
  
  document.querySelectorAll('table').forEach(table => {
    const wrapper = document.createElement('div');
    wrapper.classList.add('scroll');
    table.parentNode.insertBefore(wrapper, table);
    wrapper.appendChild(table);
  });
}

const openTabs = () => {
  const tabGroups = document.querySelectorAll(".target__wrap");

  tabGroups.forEach((group) => {
    const tabsLinks = group.querySelectorAll(".target__list-item");
    const allContentBlocks = group.querySelectorAll(".target__content");
    let frontBlockId = tabsLinks[0].dataset.name; // перший таб активний за замовчуванням

    function addTabsActive() {
      tabsLinks.forEach((button, index) => {
        button.addEventListener("click", () => {
          tabsLinks.forEach((otherButton) =>
            otherButton.classList.remove("active")
          );
          button.classList.add("active");
          showContent(button.dataset.name, index);
        });
      });
    }

    function updateActiveTab(index) {
      tabsLinks.forEach((button, i) => {
        button.classList.toggle("active", i === index);
      });
    }

    function changeSlide(blockId) {
      allContentBlocks.forEach((block) => {
        if (block.dataset.name === blockId) {
          block.style.display = "flex";
          block.style.opacity = 1;
        } else {
          block.style.opacity = 0;
          block.style.display = "none";
        }
      });
      frontBlockId = blockId;
    }

    function showContent(itemName, index) {
      changeSlide(itemName);
      updateActiveTab(index);
    }

    addTabsActive();
    showContent(frontBlockId, 0); // показати перший таб
  });
};


const servicesMore = () =>{
	const servicesContentItem = document.querySelectorAll('.services__content__item');
	if(!servicesContentItem) return;
	servicesContentItem.forEach((servicesItem) =>{
		const servicesItemList = servicesItem.querySelectorAll('.services__content__item-list a');
		if(servicesItemList.length >=1){
			servicesItem.classList.add('has-children');
		} else {
			servicesItem.classList.add('zero-children');
		}  
	})
}
const reviewsSliderInit = () => {
		const reviewsSectionsSLider = document.querySelectorAll('.reviews__slider__wrapper');
	if (!reviewsSectionsSLider.length) return;

	reviewsSectionsSLider.forEach(section => {
		if (!section.classList.contains('withoutSlider')) {
			const sliderContainer = section.querySelector('.reviewsSlider');
			if (!sliderContainer) return;
			new Swiper(sliderContainer, {
				slidesPerView: 1.15,
				spaceBetween: 10,
				breakpoints: {
					320: {
						slidesPerView: 1.25,
					},
					768: {
						slidesPerView: 1.75,
					},
					1024: {
						slidesPerView: 2.25,
					}
				},
				navigation: {
					nextEl: section.querySelector('.reviews-button-next'),
					prevEl: section.querySelector('.reviews-button-prev'),
				},
			});
		} else {
			const sliderWrapper = section.querySelector('.reviews__slider');
			if (!sliderWrapper) return;

			const elements = sliderWrapper.querySelectorAll('*');
			elements.forEach(el => {
				Array.from(el.classList).forEach(cls => {
					if (cls.startsWith('swiper-') || cls === 'swiper') {
						el.classList.remove(cls);
					}
				});
			});
		}
	});
};
const doctorReviewsSliderInit = () => {
		const doctorReviewsSectionsSLider = document.querySelectorAll('.reviews__slider__wrapper');
	if (!doctorReviewsSectionsSLider.length) return;


	doctorReviewsSectionsSLider.forEach(section => {
		if (!section.classList.contains('withoutSlider')) {
			const sliderContainer = section.querySelector('.doctorReviewsSlider');
			if (!sliderContainer) return;
			new Swiper(sliderContainer, {
				slidesPerView: 1.15,
				spaceBetween: 10,
			
				navigation: {
					nextEl: section.querySelector('.reviews-button-next'),
					prevEl: section.querySelector('.reviews-button-prev'),
				},
			});
		} else {
			const sliderWrapper = section.querySelector('.reviews__slider');
			if (!sliderWrapper) return;

			const elements = sliderWrapper.querySelectorAll('*');
			elements.forEach(el => {
				Array.from(el.classList).forEach(cls => {
					if (cls.startsWith('swiper-') || cls === 'swiper') {
						el.classList.remove(cls);
					}
				});
			});
		}
	});
};
const doctorPublicSliderInit = () => {
		const doctorPublicSectionsSLider = document.querySelectorAll('.public__slider__wrapper');
	if (!doctorPublicSectionsSLider.length) return;
	doctorPublicSectionsSLider.forEach(section => {
		if (!section.classList.contains('withoutSlider')) {
			const sliderContainer = section.querySelector('.doctorPublicSlider');
			if (!sliderContainer) return;
			new Swiper(sliderContainer, {
  slidesPerView: 1.2,
  centeredSlides: true,
  spaceBetween: 10,
	observer: true,
  observeParents: true,
  autoHeight: true,
  navigation: {
    nextEl: section.querySelector('.public-button-next'),
    prevEl: section.querySelector('.public-button-prev'),
  },
  on: {
    init: function () {
      this.updateAutoHeight(300); 
    },
    slideChange: function () {
      this.updateAutoHeight(300); 
    }
  }
});
		} else {
			const sliderWrapper = section.querySelector('.public__slider');
			if (!sliderWrapper) return;
			const elements = sliderWrapper.querySelectorAll('*');
			elements.forEach(el => {
				Array.from(el.classList).forEach(cls => {
					if (cls.startsWith('swiper-') || cls === 'swiper') {
						el.classList.remove(cls);
					}
				});
			});
		}
	});
};


const reviewsFormChecked = () =>{
	const reviewForm =  document.querySelector(".reviewForm__wrap");
	if (reviewForm) {
    const commentForm = reviewForm.querySelector('form');
    const commentName = reviewForm.querySelector('input[name="review-name"]');
    const commentProduct = reviewForm.querySelector('input[name="review-product"]');
    const commentEmail = reviewForm.querySelector('input[name="review-email"]');
    const commentText = reviewForm.querySelector('textarea[name="review-text"]');
    const commentButton = reviewForm.querySelector('input[type="submit"]');

    commentButton.addEventListener("click", function (e) {
      const ratingElement = document.querySelector(
        'input[name="rating"]:checked'
      );
      const rating = ratingElement ? ratingElement.value : "";
      const commentPost = this.getAttribute("data-post-id");
      e.preventDefault();
      var xhr = new XMLHttpRequest();
      if (commentName.value && commentSurname && commentText) {
        xhr.open("POST", script_js.ajax_url, true);
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        xhr.send(
          "comment_name=" +
            commentName.value +
            "&comment_email=" +
            commentEmail.value +
            "&rating=" +
            rating +
            "&comment_Product=" +
            commentProduct.value +
            "&comment_text=" +
            commentText.value +
            "&commentPost=" +
            commentPost +
            "&action=new_comment_function"
        );
        xhr.onload = function () {
          if (this.status >= 200 && this.status < 400) {
            commentForm.reset();
            alert(
              script_js.currentLang === "uk"
                ? "Ваш відгук було надіслано"
                : "Ваш отзыв был отправлен"
            );
          } else {
            alert(
              script_js.currentLang === "uk"
                ? "Заповніть форму"
                : "Заполните форму"
            );
          }
        };
      } else {
        alert(
          script_js.currentLang === "uk"
            ? "Заповніть форму"
            : "Заполните форму"
        );
      }
    });
  }
}

const showVideo = () =>{
const mediaVideo = document.querySelectorAll('.media__video');
mediaVideo.forEach(block => {
  block.addEventListener('click', () => {
    const videoUrl = block.dataset.videoUrl;
    if (!videoUrl) return;

    const embedUrl = videoUrl
      .replace('https://youtu.be/', 'https://www.youtube.com/embed/')
      .replaceAll('/shorts/', '/embed/')
      .replaceAll('watch?v=', 'embed/');

    const iframe = document.createElement('iframe');
    iframe.setAttribute('src', embedUrl + '?autoplay=1&rel=0&cc_load_policy=1');
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
    iframe.setAttribute('allowfullscreen', true);
    iframe.style.width = '80%';
    iframe.style.height = '80%';
    iframe.style.maxWidth = '1280px';
    iframe.style.maxHeight = '720px';
    iframe.style.borderRadius = '8px';

    const overlay = document.createElement('div');
		overlay.className = 'overlay';
    
    
    overlay.appendChild(iframe);
    document.body.appendChild(overlay);
		const closeBtn = document.createElement('div');
      closeBtn.style.position = 'absolute';
      closeBtn.className = "closeIframe";
			overlay.appendChild(closeBtn);

    requestAnimationFrame(() => overlay.style.opacity = '1');

    overlay.addEventListener('click', e => {
      if (e.target === overlay) {
        overlay.style.opacity = '0';
        setTimeout(() => document.body.removeChild(overlay), 300);
      }
    });
    closeBtn.addEventListener('click', () => {
			overlay.style.opacity = '0';
			setTimeout(() => document.body.removeChild(overlay), 300);
		});
  });
});
}
const reviewsMore = () => {
  document.querySelectorAll('.reviews__item').forEach(item => {
    const content = item.querySelector('.reviews__bottom'); 
    if (!content) return;

    const paragraphs = content.querySelectorAll('p');
    let totalHeight = 0;

    paragraphs.forEach(p => {
      totalHeight += p.scrollHeight;
    });
    if (totalHeight > content.clientHeight) {
      const btn = document.createElement('button');
      btn.textContent = 'Розгорнути';
      btn.className = 'reviews__expand-btn';

      btn.addEventListener('click', () => {
        content.classList.toggle('expanded');
        btn.textContent = content.classList.contains('expanded') ? 'Згорнути' : 'Розгорнути';
      });
      content.insertAdjacentElement('afterend', btn);
    }
  });
};

const linksMore = () => {
  document.querySelectorAll('.link__wrapper').forEach(item => {
    const ul = item.querySelector('ul');
    const links = ul ? ul.querySelectorAll('li') : [];

    if (links.length <= 15) return;
    links.forEach((li, index) => {
      if (index > 14) {
        li.classList.add('hidden');
      } else {
        li.classList.add('visible');
      }
    });
    const btn = document.createElement('button');
    btn.textContent = 'Переглянути всі';
    btn.className = 'link__more_btn';

    btn.addEventListener('click', () => {
      const isExpanded = btn.textContent === 'Приховати';

      if (isExpanded) {
        links.forEach((li, index) => {
          if (index > 14) {
            li.classList.remove('visible');
            li.classList.add('hidden');
          }
        });
        btn.textContent = 'Переглянути всі';
				btn.classList.remove('expanded');
      } else {
        // Показуємо всі
        links.forEach(li => {
          li.classList.remove('hidden');
          li.classList.add('visible');
        });
        btn.textContent = 'Приховати';
				btn.classList.add('expanded');
      }
    });

    ul.insertAdjacentElement('afterend', btn);
  });
};
const showMoreContent = () => {
  document.querySelectorAll('.content__expand').forEach(button => {
    button.addEventListener('click', () => {
      const contentBlock = button.closest('.content');
      if (!contentBlock) return;
      const body = contentBlock.querySelector('.content__body');
      if (!body) return;
      const isExpanded = body.classList.toggle('content__body-expanded');
      const expandText = button.getAttribute('data-expand') || 'Розгорнути';
      const collapseText = button.getAttribute('data-collapse') || 'Згорнути';
      button.textContent = isExpanded ? collapseText : expandText;
      if (isExpanded) {
        contentBlock.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
}

const upDoctor = () => {
  const doctors = Array.from(document.querySelectorAll('.doctor'));
  if (!doctors.length) return;

  const recalc = () => {
    const vw = window.innerWidth || document.documentElement.clientWidth;

    doctors.forEach((doctor) => {
      const imageBlock  = doctor.querySelector('.doctor__image');
      const bottomBlock = doctor.querySelector('.doctor__bottom');
      if (!imageBlock || !bottomBlock) return;
      bottomBlock.style.marginTop = '0px';

      if (vw < 768) return;

      const imgRect    = imageBlock.getBoundingClientRect();
      const bottomRect = bottomBlock.getBoundingClientRect();
      const gap = bottomRect.top - imgRect.bottom;
      if (gap > 0) {
        bottomBlock.style.marginTop = `${-gap}px`;
      }
    });
  };

  recalc();

  let rafId;
  const onResize = () => {
    cancelAnimationFrame(rafId);
    rafId = requestAnimationFrame(recalc);
  };
  window.addEventListener('resize', onResize);
  doctors.forEach((doctor) => {
    doctor.querySelectorAll('.doctor__image img').forEach((img) => {
      if (!img.complete) {
        img.addEventListener('load', recalc, { once: true });
      }
    });
  });
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', upDoctor, { once: true });
} else {
  upDoctor();
}


/**
 * Woo JS
 */

 document.addEventListener("DOMContentLoaded", function () {

});

/**
 * Fancybox
 */

 window.Fancybox?.bind?.("[data-fancybox]", {});