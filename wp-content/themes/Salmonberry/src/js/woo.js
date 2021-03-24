/* eslint-disable no-unused-vars */
/* eslint-disable no-lonely-if */
/* eslint-disable no-console */
/* eslint-disable no-undef */
import {sendAJAX} from './helpers.js';

document.addEventListener('DOMContentLoaded', () => {
    const removeOneButton = document.getElementsByClassName('remove-one-item');
    const addOneButton = document.getElementsByClassName('add-one-item');

    Array.from(removeOneButton).forEach((element)=> {
        element.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            const cartItemKey = e.target.dataset.cartItemKey;
            const cartItemQuantity = e.target.dataset.cartItemQuantity;
            // console.log(cartItemQuantity);

            if (parseInt(cartItemQuantity, 10) > 0) {
                updateItem(cartItemKey, parseInt(cartItemQuantity, 10) - 1);
            }
        });
    });

    Array.from(addOneButton).forEach((element)=> {
        element.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            const productId = e.target.dataset.productId;
            if (productId) addItem(productId);
        });
    });
});

function addItem(productId) {
    // console.log('addItem()');
    const addSuccess = document.getElementsByClassName('product__text__add__success');
    const addProgress = document.querySelector('*.product__text__add__progress[data-product-id="' + productId + '"]');

    if (addSuccess) {
        for (let success of addSuccess) {
            success.classList.remove('show');
        }
    }

    if (addProgress) {
        // for (let progress of addProgress) {
        addProgress.classList.add('show');
        // }
    }

    const data = {
        'action': 'salmonberry_add_to_cart',
        'product_id': productId,
        'product_sku': '',
        'quantity': '1'
        // 'variation_id': variation_id
    };

    sendAJAX(ajax_data.ajax_url, data, updateItemSuccess);
}

function updateItem(hash, qty) {
    // console.log('updateItems()');
    const data = {
        'action': 'salmonberry_update_cart',
        'hash': hash,
        'nonce': ajax_data.nonce,
        'quantity': qty
    };

    sendAJAX(ajax_data.ajax_url, data, updateItemSuccess);
}

function updateItemSuccess(data) {
    // console.log('updateItemSuccess: ');
    // console.log(data);
    const json = JSON.parse(data);
    // console.log(json);
    const quantity = json.quantity ? json.quantity : 0;
    const add = document.querySelector('*.add-one-item[data-product-id="' + json.product_id + '"]');
    const addProgress = document.querySelector('*.product__text__add__progress[data-product-id="' + json.product_id + '"]');
    const remove = document.querySelector('*.remove-one-item[data-product-id="' + json.product_id + '"]');
    const display = document.querySelector('*.display-item[data-product-id="' + json.product_id + '"]');
    const cartItemTotal = document.getElementsByClassName('cart-item-total');
    const addSuccess = document.querySelector('*.product__text__add__success[data-product-id="' + json.product_id + '"]');

    if (add) { add.setAttribute('data-cart-item-quantity', quantity); }
    if (add) { add.setAttribute('data-cart-item-key', json.key); }
    if (remove) { remove.setAttribute('data-cart-item-quantity', quantity); }
    if (remove) { remove.setAttribute('data-cart-item-key', json.key); }
    if (display && quantity) { display.innerHTML = quantity + ' in cart'; } else if (display) { display.innerHTML = '0 in cart'; }
    if (cartItemTotal) {
        for (let disp of cartItemTotal) {
            disp.innerHTML = json.cart_total;
        }
    }
    if (addSuccess) {
        // for (let one of addSuccess) {
        // one.classList.remove('show');
        addProgress.classList.remove('show');
        addSuccess.classList.add('show');
        // }
    }
}
