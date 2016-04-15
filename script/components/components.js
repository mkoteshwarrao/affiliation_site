app.directive('cHeader', function() {
   
   return{
         restrict:'E',
         templateUrl:'pages/header.html'
   };

});

app.directive('cFooter', function() {
   
   return{
         restrict:'E',
         templateUrl:'pages/footer.html'
   };

});

app.directive('pDetails', function() {
    return {
      template: '<div>'+
        '<h2>{{item.title}}</h2>'+
        '<img  ng-src="{{item.imgMid}}" height="250 px" />'+
        '<div>{{item.description}}</div>'+
        '<button class="btn-primary" href="{{item.url}}"><h1>{{ item.title}}</h1></button><br>'+
        '<a ng-href="#/products/">back</a>'+
      '</div>',
      restrict: 'E'
     };
});
