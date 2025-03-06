class Pizza {
    constructor(name, size) {
        this.name = name;
        this.size = size;
        this.extras = [];
    }

    addExtras(extra) {
        this.extras.push(extra);
    }

    calculatePrice() {
        let price = 0;

        // base pizza's price
        switch (this.name) {
            case 'pizza_margarita':
                price = 500;
                break;
            case 'pizza_pepperoni':
                price = 800;
                break;
            case 'pizza_bavarian':
                price = 700;
                break;
        }

        // + size price
        if (this.size === 'size_large') {
            price += 200;
        } else {
            price += 100;
        }

        // + extras price
        // не смотря на то, что во всех случаях добавляется одинаковая стоимость, у кода есть возможность изменить стоимость для конкретной добавки в будущем
        this.extras.forEach(extra => {
            switch (extra) {
                case 'extra_creamy_mozarella':
                    price += this.size === 'size_large' ? 300 : 150;
                    break;
                case 'extra_cheese_board':
                    price += this.size === 'size_large' ? 300 : 150;
                    break;
                case 'extra_cheddar_parmesan':
                    price += this.size === 'size_large' ? 300 : 150;
                    break;
            }
        });

        return price;
    }

    calculateCalories() {
        let calories = 0;

        // base pizza's calories
        switch (this.name) {
            case 'pizza_margarita':
                calories = 300;
                break;
            case 'pizza_pepperoni':
                calories = 400;
                break;
            case 'pizza_bavarian':
                calories = 450;
                break;
        }

        // + size calories
        if (this.size === 'size_large') {
            calories += 200;
        } else {
            calories += 100;
        }
        
        // + extras calories
        // не смотря на то, что во всех случаях добавляется одинаковая калорийность, у кода есть возможность изменить калорийность для конкретной добавки в будущем
        this.extras.forEach(extra => {
            switch (extra) {
                case 'extra_creamy_mozarella':
                    calories += this.size === 'size_large' ? 50 : 50;
                    break;
                case 'extra_cheese_board':
                    calories += this.size === 'size_large' ? 50 : 50;
                    break;
                case 'extra_cheddar_parmesan':
                    calories += this.size === 'size_large' ? 50 : 50;
                    break;
            }
        });
        
        return calories;
    }
}

document.querySelector('.pizza_result_button').addEventListener('click', () => {
    const pizzaName = document.getElementById('pizza_name').value;
    const pizzaSize = document.getElementById('pizza_size').value;
    const selectedExtras = Array.from(document.querySelectorAll('.checkboxes input[type="checkbox"]:checked')).map(checkbox => checkbox.value);

    const pizza = new Pizza(pizzaName, pizzaSize);

    selectedExtras.forEach(extra => pizza.addExtras(extra));

    const price = pizza.calculatePrice();
    const calories = pizza.calculateCalories();

    const priceElement = document.getElementById('price_result');
    const caloriesElement = document.getElementById('calories_result');

    priceElement.textContent = `Стоимость пиццы: ${price} рублей`;
    caloriesElement.textContent = `Калорийность: ${calories} Ккалорий`;
});