class Product {
    constructor(smallPrice, smallCalories, largePrice, largeCalories) {
        this.smallPrice = smallPrice
        this.smallCalories = smallCalories
        this.largePrice = largePrice
        this.largeCalories = largeCalories
    }

    getPrice(isLarge) {
        if (isLarge) {
            return this.largePrice
        } else {
            return this.smallPrice
        }
    }

    getCalories(isLarge) {
        if (isLarge) {
            return this.largeCalories
        } else {
            return this.smallCalories
        }
    }
}

const products = {
    margarita: new Product(600, 400, 700, 500),
    pepperoni: new Product(900, 500, 1000, 600),
    bavarian: new Product(800, 550, 900, 650),
    //указаны произвольные значения стоимости и калорийности
    cheese_board: new Product(189, 60, 279, 100),
    creamy_mozarella: new Product(99, 40, 169, 70),
    cheddar_parmesan: new Product(99, 50, 169, 85)
}

const sizeToggle = document.getElementById('size_toggle')
const pizzaRadios = document.querySelectorAll('.pizza_radio')
const extraCheckboxes = document.querySelectorAll('.extra_checkbox')
const addToCartButton = document.querySelector('.add_to_cart_text')

function updatePrices() {
    const isLarge = sizeToggle.checked

    document.getElementById('price_margarita').textContent = `${products.margarita.getPrice(isLarge)} ₽`
    document.getElementById('price_pepperoni').textContent = `${products.pepperoni.getPrice(isLarge)} ₽`
    document.getElementById('price_bavarian').textContent = `${products.bavarian.getPrice(isLarge)} ₽`
    document.getElementById('price_cheese_board').textContent = `${products.cheese_board.getPrice(isLarge)} ₽`
    document.getElementById('price_creamy_mozarella').textContent = `${products.creamy_mozarella.getPrice(isLarge)} ₽`
    document.getElementById('price_cheddar_parmesan').textContent = `${products.cheddar_parmesan.getPrice(isLarge)} ₽`
}

function updateCart() {
    const isLarge = sizeToggle.checked
    let totalPrice = 0
    let totalCalories = 0

    pizzaRadios.forEach(radio => {
        if (radio.checked) {
            const productKey = radio.dataset.product
            totalPrice += products[productKey].getPrice(isLarge)
            totalCalories += products[productKey].getCalories(isLarge)
        }
    });

    extraCheckboxes.forEach(checkbox => {
        if (checkbox.checked) {
            const productKey = checkbox.dataset.product
            totalPrice += products[productKey].getPrice(isLarge)
            totalCalories += products[productKey].getCalories(isLarge)
        }
    });

    addToCartButton.textContent = `Добавить в корзину за ${totalPrice} ₽ (${totalCalories} Ккал)`
}

sizeToggle.addEventListener('change', () => {
    updatePrices()
    updateCart()
})

pizzaRadios.forEach(radio => {
    radio.addEventListener('change', updateCart)
})

extraCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateCart)
})

window.addEventListener('load', () => {
    updatePrices()
    updateCart()
})