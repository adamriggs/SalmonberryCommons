/* eslint-disable no-unused-vars */
/* eslint-disable no-lonely-if */
/* eslint-disable no-console */
import 'intersection-observer';
import anime from 'animejs/lib/anime.es.js';

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
    const urlParams = new URLSearchParams(window.location.search);
    const searchTerm = urlParams.get('s');
    Array.from(searchButton).forEach((element)=> {
        element.addEventListener('click', () => {
            let searchArea = element.classList.contains('search__header') ? 'search__header' : 'search__footer';
            mobileCart.classList.toggle('show');
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
});
