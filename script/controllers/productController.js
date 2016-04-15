app.controller('productController', ['$scope', '$routeParams','$modal', '$http', 'productsService',

    function productController($scope,$routeParams, $modal, $http, productsService) {

        $scope.data = {};
        $scope.productId = $routeParams.productId || null;


        $scope.products = {};
        $scope.myModal = $scope.myModal | {};

        $scope.getProducts = productsService.getProducts("data/category.json");

        $scope.getProducts.then(

            function(items) {
                $scope.data = items.data;
            },

            function(reason) {

            }
        );

        $scope.ini = productsService.getProducts("data/home_improvement.json");

        $scope.ini.then(

            function(data) {
                $scope.products = data.data;
            },

            function(reason) {

            }
        );


        $scope.carousel = productsService.getProducts("data/home_improvement.json");

        $scope.carousel.then(

            function(data) {
                $scope.carouseldata = data.data;
            },

            function(reason) {

            }
        );


        $scope.showDetails = function(item) {

            $scope.item = item;
                    $scope.myModal = $modal({
                        scope: $scope,
                        templateUrl: 'pages/pdetails.html',
                        show: true,
                        backdrop: 'static'
                    });

            $scope.myModal.$promise.then($scope.myModal.show);
            
            /*$scope.getProduct = productsService.getProduct(value);
            $scope.getProduct.then(

                function(item) {

                    $scope.item = item;
                    $scope.myModal = $modal({
                        scope: $scope,
                        templateUrl: 'pages/pdetails.html',
                        show: true,
                        backdrop: 'static'
                    });

                    $scope.myModal.$promise.then($scope.myModal.show);
                },

                function(reason) {

                }
            );*/
        };

        $scope.hideModal = function() {
            $scope.myModal.$promise.then($scope.myModal.hide);
        };

        $scope.addProduct = function() {
            if (!$scope.Object.id) {
                $scope.Object.id = $scope.products.length; /*this will add duplicate ids in reality */
                $scope.products.push($scope.Object);
            }
            $scope.Object = {};
        };

        $scope.editProduct = function(item) {
            $scope.Object = new Object(item);
        };

        $scope.showProduct = function(item) {

            $scope.getProducts = productsService.getProducts("data/" + item.url);

            $scope.getProducts.then(
                function(data) {
                    $scope.products = data.data;
                },
                function(reason) {

                }
            );

        };

    }
]);
