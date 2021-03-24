/* eslint-disable no-unused-vars */
import 'intersection-observer';
import anime from 'animejs/lib/anime.es.js';

document.addEventListener('DOMContentLoaded', () => {
    const easeOut = 'easeOutQuad';
    const easeIn = 'easeInQuad';
    const duration = '800';
    const delay = '400';

    const homePrimaryArrowClass = '.home__primary__arrow .arrow__down';
    const homePrimaryArrowNode = document.querySelector(homePrimaryArrowClass);

    const homeSecondaryArrowClass = '.home__secondary__arrow';
    const homeSecondaryArrowNode = document.querySelector(homeSecondaryArrowClass);

    const homeTertiaryRowClass = '.home__tertiary__row__head';
    const homeTertiaryRowNodes = document.querySelectorAll(homeTertiaryRowClass);

    const homeIO = new IntersectionObserver(
        entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting === true) {
                    if (entry.target === homePrimaryArrowNode) {
                        anime({
                            delay: delay,
                            duration: duration,
                            easing: easeOut,
                            height: ['0px', '160px'],
                            targets: homePrimaryArrowClass
                        });
                    }

                    if (entry.target === homeSecondaryArrowNode) {
                        anime({
                            delay: delay,
                            duration: duration,
                            easing: easeOut,
                            height: ['0px', '160px'],
                            targets: homeSecondaryArrowClass
                        });
                    }

                    for (const element of homeTertiaryRowNodes) {
                        if (entry.target === element) {
                            anime({
                                delay: delay,
                                duration: duration,
                                easing: easeOut,
                                height: ['0px', '55px'],
                                targets: element.getElementsByClassName('arrow__down')
                            });

                            anime({
                                delay: delay * 2,
                                duration: duration,
                                easing: easeOut,
                                targets: element.getElementsByClassName('arrow__right'),
                                width: ['0px', '112px']
                            });
                        }
                    }
                } else {
                    if (entry.target === homePrimaryArrowNode) {
                        anime({
                            targets: homePrimaryArrowClass,
                            height: '0px',
                            duration: duration,
                            easing: easeIn
                        });
                    }

                    if (entry.target === homeSecondaryArrowNode) {
                        anime({
                            targets: homeSecondaryArrowClass,
                            height: '0px',
                            duration: duration,
                            easing: easeIn
                        });
                    }

                    for (const element of homeTertiaryRowNodes) {
                        if (entry.target === element) {
                            anime({
                                delay: delay,
                                duration: duration,
                                easing: easeOut,
                                height: '0px',
                                targets: element.getElementsByClassName('arrow__down')
                            });

                            anime({
                                delay: delay,
                                duration: duration,
                                easing: easeOut,
                                targets: element.getElementsByClassName('arrow__right'),
                                width: '0px'
                            });
                        }
                    }
                }
            });
        },
        {
            // threshold: [1]
        }
    );

    homeIO.observe(homePrimaryArrowNode);
    homeIO.observe(homeSecondaryArrowNode);

    for (const element of homeTertiaryRowNodes) {
        homeIO.observe(element);
    }
});
