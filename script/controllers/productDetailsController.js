app.controller('productDetailsController',

    ['$scope', '$stateParams', 'productsService',
        function productDetailsController($scope, $stateParams, productsService) {

            $scope.productId = $stateParams.productId;

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
