/*app.config(function($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('/products');

    $stateProvider
        .state('home', {
            url: '/home',
            templateUrl: 'pages/home.html',
            controller: 'homeController'
        })
        .state('about', {
            url: '/about',
            templateUrl: 'pages/about.html',
            controller: 'aboutController'
        })
        .state('products', {
            url: '/products',

            views: {
                '': {
                    templateUrl: 'pages/productlist.html',
                    controller: 'productController'
                },
                '/{productId}': {
                    templateUrl: 'pages/productdetails.html',
                    controller: 'productDetailsController'
                }
            }
        })
        .state('products/{productId}', {
            url: '/products/{productId}',
            templateUrl: 'pages/productdetails.html',
            controller: 'productDetailsController'
        })

});

*/

app.config(['$routeProvider',function($routeProvider) {
    $routeProvider.
      when('/', {
        templateUrl: 'pages/home.html',
        controller: 'homeController'
      }).
      when('/products', {
        templateUrl: 'pages/productlist.html',
        controller: 'productController'
      }).
      when('/products/:productId', {
        templateUrl: 'pages/productdetails.html',
        controller: 'productDetailsController'
      }).
      when('/about', {
        templateUrl: 'pages/about.html',
        controller: 'aboutController'
      }).
      otherwise({
        redirectTo: '/products'
      });
  }]);

