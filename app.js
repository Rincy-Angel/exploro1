//app.js
(function() {
var app = angular.module('myApp', ['ui.router']);
app.run(function($rootScope, $location, $state, LoginService) {
console.clear();
console.log('running');
if(!LoginService.isAuthenticated()) {
$state.transitionTo('login');
}
});
app.config(['$stateProvider', '$urlRouterProvider',
function($stateProvider, $urlRouterProvider) {
$stateProvider
.state('login', {
url : '/login',
templateUrl : 'login.html',
controller : 'LoginController'
})
.state('home', {
url : '/home',
templateUrl : 'home.html',
controller : 'HomeController'
});
$urlRouterProvider.otherwise('/login');
}]);
})();
