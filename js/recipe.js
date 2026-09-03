 const recipesData = {
            salad: {
                title: "Fresh Avocado Salad",
                badge: "Healthy / Salad",
                image: "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800",
                rating: "4.9 (85 reviews)",
                desc: "A healthy and crisp salad topped with creamy avocado and lemon dressing.",
                prep: "10 min", cook: "0 min", diff: "Easy", servings: "2",
                ingredients: ["2 Ripe Avocados (sliced)", "1 cup Cherry Tomatoes", "1 cup Cucumber (diced)", "1 tbsp Olive Oil", "1 tbsp Lemon Juice", "Salt and Pepper"],
                instructions: ["Wash and chop all vegetables into bite-sized pieces.", "Place ingredients in a large bowl.", "Drizzle with olive oil and fresh lemon juice.", "Toss gently and serve fresh!"]
            },
            pizza: {
                title: "Classic Cheese Pizza",
                badge: "Fast Food",
                image: "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800",
                rating: "4.8 (210 reviews)",
                desc: "Freshly baked pizza with extra mozzarella cheese and rich tomato sauce.",
                prep: "20 min", cook: "15 min", diff: "Medium", servings: "4",
                ingredients: ["1 Pizza Dough base", "1/2 cup Tomato Pizza Sauce", "2 cups Mozzarella Cheese (shredded)", "1 tbsp Olive Oil", "Fresh Basil leaves"],
                instructions: ["Preheat oven to 220°C (425°F).", "Spread tomato sauce evenly over the pizza dough.", "Top generously with shredded mozzarella cheese.", "Bake for 12-15 minutes until cheese is melted and crust is golden."]
            },
            waffles: {
                title: "Berry Waffle Pancakes",
                badge: "Breakfast / Dessert",
               image: "images/Belgian-Waffls.jpg",
                rating: "4.7 (140 reviews)",
                desc: "Fluffy pancakes served with fresh berries, maple syrup, and whipped cream.",
                prep: "15 min", cook: "10 min", diff: "Easy", servings: "3",
                ingredients: ["1 cup Flour", "1 cup Milk", "1 Egg", "1/2 cup Fresh Strawberries & Blueberries", "Maple syrup", "Whipped Cream"],
                instructions: ["Whisk flour, milk, and egg together in a bowl until smooth.", "Heat waffle maker or non-stick pan.", "Pour batter and cook until golden brown.", "Serve hot topped with fresh berries and maple syrup!"]
            }
        };

    
        const urlParams = new URLSearchParams(window.location.search);
        const selectedId = urlParams.get('id') || 'salad'; 
        const recipe = recipesData[selectedId];

        
        document.getElementById('recipe-title').innerText = recipe.title;
        document.getElementById('recipe-badge').innerText = recipe.badge;
        document.getElementById('recipe-img').src = recipe.image;
        document.getElementById('recipe-rating').innerText = recipe.rating;
        document.getElementById('recipe-desc').innerText = recipe.desc;
        document.getElementById('prep-time').innerText = recipe.prep;
        document.getElementById('cook-time').innerText = recipe.cook;
        document.getElementById('difficulty').innerText = recipe.diff;
        document.getElementById('servings').innerText = recipe.servings;

       
        const ingList = document.getElementById('ingredients-list');
        recipe.ingredients.forEach(item => {
            ingList.innerHTML += `<li>• ${item}</li>`;
        });

       
        const insList = document.getElementById('instructions-list');
        recipe.instructions.forEach(step => {
            insList.innerHTML += `<li>${step}</li>`;
        });


