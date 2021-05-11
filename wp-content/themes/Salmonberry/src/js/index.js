/* eslint-disable no-unused-vars */
/* eslint-disable no-lonely-if */
/* eslint-disable no-loop-func */
import 'intersection-observer';
import anime from 'animejs/lib/anime.es.js';
import { getCookie } from './helpers.js';
import { setCookie } from './helpers.js';

document.addEventListener('DOMContentLoaded', () => {
    // ANIMATIONS
    const easeOut = 'easeOutQuad';
    const easeIn = 'easeInQuad';
    const duration = '800';
    const delay = '400';

    const footerArrowClass = '.footer__arrow';
    const footerArrowNode = document.querySelector(footerArrowClass);

    const homeIO = new IntersectionObserver(
        entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting === true) {
                    if (entry.target === footerArrowNode) {
                        anime({
                            delay: delay * 3,
                            duration: duration,
                            easing: easeOut,
                            targets: footerArrowClass,
                            width: ['0px', '160px']
                        });
                    }
                } else {
                    if (entry.target === footerArrowNode) {
                        anime({
                            duration: duration,
                            easing: easeOut,
                            targets: footerArrowClass,
                            width: '0px'
                        });
                    }
                }
            });
        },
        {
            // threshold: [1]
        }
    );

    homeIO.observe(footerArrowNode);

    // MENU STUFF
    document.querySelectorAll('header .menu-item-has-children').forEach(node => {
        node.addEventListener('mouseenter', e => {
            e.preventDefault();
            e.stopPropagation();
            e.target.classList.add('menu-open');
        });
        node.addEventListener('mouseleave', e => {
            e.preventDefault();
            e.stopPropagation();
            e.target.classList.remove('menu-open');
        });
    });

    const hamburger = document.getElementById('hamburger-menu');
    const mobileMenu = document.getElementById('menu__mobile');
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('is-active');
        mobileMenu.classList.toggle('show');
    });

    // SEARCH STUFF
    const searchButton = document.getElementsByClassName('search__button');
    const searchInput = document.getElementsByClassName('search__input');
    const mobileCart = document.querySelector('div#menu__mobile a.header__cart');
    const orderby = document.querySelector('.header__orderby');
    const urlParams = new URLSearchParams(window.location.search);
    const searchTerm = urlParams.get('s');
    Array.from(searchButton).forEach((element)=> {
        element.addEventListener('click', () => {
            let searchArea = element.classList.contains('search__header') ? 'search__header' : 'search__footer';
            mobileCart.classList.toggle('show');
            orderby.classList.toggle('hide');
            Array.from(searchInput).forEach((input)=> {
                input.classList.toggle('show');
                input.focus();
                input.select();
                let curInput = input.value.trim();
                if (input.value.trim() !== '' && curInput !== searchTerm) {
                    let href = window.location.origin;
                    let search = '/?s=' + curInput;
                    window.location = href + search;
                }
            });
        });
    });

    Array.from(searchInput).forEach((element) => {
        element.addEventListener('keyup', (event) => {
            if (event.keyCode === 13 && element.value.trim() !== '') {
                let href = window.location.origin;
                let search = '/?s=' + element.value;
                window.location = href + search;
            } else if (event.keyCode === 13 && element.value.trim() === '') {
                element.classList.toggle('show');
            }
        });
    });

    // REGION STUFF
    const cookieName = 'salmonberry_region';
    const regionDialog = document.getElementsByClassName('region__selection');
    const regionButtons = document.getElementsByClassName('region__option__button');
    const regionDisplay = document.getElementsByClassName('region__display');
    const regionDisplayText = document.getElementsByClassName('region__display__text');
    const regionChange = document.getElementsByClassName('region__display__change');
    let region = getCookie(cookieName);

    // set up event for removing region dialog from the screen
    for (let dialog of regionDialog) {
        dialog.addEventListener('transitionend', () => {
            if (dialog.classList.contains('hide')) {
                dialog.classList.add('remove');
            }
        });
    }

    // load region from cookie, if any
    if (region === '') {
        for (let dialog of regionDialog) {
            dialog.classList.remove('hide');
            dialog.classList.remove('remove');
        }
    } else {
        displayRegion();
    }

    // set region cookie based on button click
    for (let button of regionButtons) {
        button.addEventListener('click', () => {
            region = button.dataset.region;
            if (setCookie('salmonberry_region', button.dataset.region, 30)) {
                for (let dialog of regionDialog) {
                    dialog.classList.add('hide');
                }
                displayRegion();
                location.reload();
            }
        });
    }

    // change the region at user request
    for (let change of regionChange) {
        change.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            for (let dialog of regionDialog) {
                dialog.classList.remove('remove');
                dialog.classList.remove('hide');
            }
        });
    }

    function displayRegion() {
        for (let display of regionDisplayText) {
            const str = region.split('-').join('\xa0');
            const textNode = document.createTextNode('Delivery Zone: ' + str);
            display.innerHTML = '';
            display.prepend(textNode);
        }
    }

    // PRODUCT TILE IMAGE SIZING
    const productImage = document.getElementsByClassName('product__image');

    window.addEventListener('resize', resizeEvent);

    function resizeEvent() {
        Array.from(productImage).forEach(element => {
            const left = parseInt(window.getComputedStyle(element, null).getPropertyValue('padding-left'), 10);
            const right = parseInt(window.getComputedStyle(element, null).getPropertyValue('padding-right'), 10);
            const padding = left + right;
            element.style.height = (element.offsetWidth - padding) + 'px';
        });
    }

    resizeEvent();
});
