app.directive('cHeader', function() {

    return {
        restrict: 'E',
        templateUrl: 'pages/header.html',
        controller:"productController"
    };

});

app.directive('cFooter', function() {

    return {
        restrict: 'E',
        templateUrl: 'pages/footer.html'
    };

});

app.directive('pDetails', function() {
    return {
        template: '<div>' +
            '<h2>{{item.title}}</h2>' +
            '<h2>Colour : {{item.color}}</h2>' +
            '<h2>Price : {{item.price}}</h2>' +
            '<img ng-src="{{item.image}}" width="100 px" height="100 px" />' +
            '<div>{{item.info}}</div>' +
            '<a ng-href="#/products">back</a>' +
            '</div>',
        restrict: 'E'
    };
});


app.directive('productGrid', function() {
    return {
        restrict: 'E',
        template: '<div class="container-fluid">' +
            '<table class="table">' +
            '<thead>' +
            '<tr>' +
            '<th>Product</th>' +
            '<th>Price</th>' +
            '<th>Variants</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>' +
            '<tr ng-repeat="item in products" ng-click="editProduct(item)">' +
            '<td>{{item.title}}</td>' +
            '<td>{{item.price }}</td>' +
            '<td><div style="background-color:{{item.color }};">{{item.color }}</div></td>' +
            '</tr>' +
            '</tbody>' +
            '</table>' +
            '</div>'
    };
})
