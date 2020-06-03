<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vyhledávání produktů</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <style>
      html, body {
        font-family: 'Nunito', sans-serif;
      }
      button:disabled {
        opacity: 0.75;
      }
    </style>
  </head>
  <body>
    <div id="app" class="max-w-lg w-full mx-auto mt-4 px-8 py-4">
      <div class="flex">
        <input v-model="input" type="text" placeholder="Zadejte vyhledávanou fázi" class="w-full border-gray-300 border p-2">
        <button v-on:click="submit" class="flex text-white bg-purple-600 ml-4 px-4 py-2" :disabled="input.length == 0">
          <svg class="h-4 my-1 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
          Vyhledat
        </button>
      </div>

      <div class="" v-if="products">
        <div v-for="product in products" id="products" class="bg-gray-100 border-gray-300 border mt-2 px-2 py-2">
          <div class="text-lg font-semibold">
            @{{ product.name }}
          </div>
          <div class="text-sm">
            @{{ product.description }}
          </div>
        </div>
        <div v-if="products.length == 0" class="py-6 text-lg">
          Bohužel jsme v naší databázi nenašli produkt který by odpovídal vašemu vyhledávání.
        </div>
      </div>
    </div>
    <script>
    var app = new Vue({
      el: '#app',
      data: {
        input: "",
        products: ""
      },
      methods: {
        submit: function () {
          fetch('/search?s=' + this.input)
          .then((response) => {
            return response.json();
          })
          .then((data) => {
            this.products = data.products;
            console.log(data.products);
          });
       }
     }
    })
    </script>
  </body>
</html>
