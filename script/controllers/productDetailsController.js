app.controller('productDetailsController',

    ['$scope', '$routeParams', 'productsService',
        function productDetailsController($scope, $routeParams, productsService) {

            $scope.productId = $routeParams.productId;

            $scope.getProduct = productsService.getProduct($scope.productId);

            $scope.getProduct.then(

                function(item) {
                    $scope.item = item;
                },

                function(reason) {

                }
            );
        }
    ]

);
