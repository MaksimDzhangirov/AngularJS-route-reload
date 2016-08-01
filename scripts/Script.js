/// <reference path="angular.min.js" />

var myApp = angular
				.module("myModule", ["ngRoute"])
				.config(function($routeProvider, $locationProvider){
					$routeProvider
						.when("/home", {
							template: "<h1>Inline Template in Action</h1>",
							controller: "homeController",
							controllerAs: "homeCtrl"
						})
						.when("/cources", {
							templateUrl: "templates/cources.html",
							controller: "courcesController",
							controllerAs: "courcesCtrl",
							caseInsensitiveMatch: true
						})
						.when("/students", {
							templateUrl: "templates/students.html",
							controller: "studentsController as studentsCtrl"
						})
						.when("/students/:id", {
							templateUrl: "templates/studentsDetails.html",
							controller: "studentsDetailsController as studentsDetailsCtrl"
						})
						.otherwise({
							redirectTo: "/home"
						})
					$locationProvider.html5Mode(true);
				})
				.controller("homeController", function () {
					this.message = "Home Page";
				})
				.controller("courcesController", function () {
					this.cources = ["C#", "VB.NET", "SQL Server", "ASP.NET"];
				})
				.controller("studentsController", function ($http, $route) {
					var vm = this;
					vm.reloadData = function () {
						$route.reload();
					}
					$http.get('getdata.php')
					.then(function(response) {
						vm.students = response.data;	
					})
				})	
				.controller("studentsDetailsController", function ($http, $routeParams) {
					var vm = this;
					$http({
						url:"getstudent.php",
						params:{id:$routeParams.id},
						method:"get"
					}).then(function(response) {
						vm.student = response.data;	
					});
				});
					
				
