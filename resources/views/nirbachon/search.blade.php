@extends('layouts.app')

@section('content')
    <div ng-controller="temsSearchController">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                <!--- ##################### display none -->
                    <div class="col-md-6" style="display:none">
                        <div class="form-group">
                            <label for="exampleInputEmail1">জাতীয় পরিচয়পত্র নম্বর </label>
                            <input type="text" name="name" onkeyup="numonly(this)" required ng-model="nationalId" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">মোবাইল নম্বর</label>
                            <input type="text" name="mobile" maxlength="11" onkeyup="numonly(this)" required ng-model="mobile" class="form-control">
                        </div>
                    </div>
                </div>
                <!--- ##################### display none -->
                <div class="row" style="display:none">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">উপজেলা</label>
                            <select class="form-control" name="upojela" required ng-model="upojela" ng-change="getProunion()" ng-options="item.upzila_name for item in upozilaList">
                                <option value="">Select a Upojila</option>
                            </select>
                            <p ng-show="userForm.upojela.$invalid && !userForm.upojela.$pristine" class="help-block">upojela required.</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">পৌরসভা / ইউনিয়ন </label>
                            <select class="form-control" name="pourosova"  required ng-model="pourosova" ng-change="getVillage()" ng-options="item.name for item in prounionList">
                                <option value="">Select a pourosova</option>
                            </select>
                            <p ng-show="userForm.pourosova.$invalid && !userForm.pourosova.$pristine" class="help-block">pourosova required.</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">গ্রাম </label>
                            <select class="form-control" name="village" required ng-model="village" ng-change="getVotkenDro()" ng-options="item.village_name for item in VilageList">
                                <option value="">Select a village</option>
                            </select>
                            <p ng-show="userForm.village.$invalid && !userForm.village.$pristine" class="help-block">village required.</p>
                        </div>
                    </div>
                </div>
                <button type="button" ng-click="getData()" class="btn btn-success">Submit</button>
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="com-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Gender</th>
                        <th>upazila</th>
                        <th>is_union</th>
                        <th>up_or_pouro_name</th>
                        <th>villege</th>
                        <th>votkendro</th>
                        <th>Booth No</th><!--it was nid-->
                        <!-- <th>mobile_no</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="n in voterData">
                        <td><% n.name %></td>
                        <td><% n.father_name %></td>
                        <td><% n.gender %></td>
                        <td><% n.upazila %></td>
                        <td><% n.is_union %></td>
                        <td><% n.up_or_pouro_name %></td>
                        <td><% n.villege %></td>
                        <td><% n.votkendro %></td>
                        <td></td>
                        <!-- <td><% n.national_id %></td> -->
                        <!-- <td><% n.mobile_no %></td> -->

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

        function numonly(input) {
            var regex = /[^0-9]/gi;
            input.value = input.value.replace(regex, "");
        }
        tms.controller('temsSearchController', function temsSearchController($scope, $http) {
            $scope.voterData = [];
            $scope.upozilaList = [];
            $scope.prounionList = [];
            $scope.VilageList = [];
            $http({
                method : "get",
                url : '{{ route('forUpojila') }}'
            }).then(function mySuccess(response) {
                $scope.upozilaList = response.data;


            }, function myError(response) {
                $scope.myWelcome = response.statusText;
            });

            $scope.getProunion = function(){
                $scope.prounionList = [];
                $scope.VilageList = [];
                $scope.voteKendroList = [];
                if(angular.isUndefined($scope.upojela)){
                    return ;
                }
                var url = "{{ route('forPourosova') }}/" + $scope.upojela.id;
                $http({
                    method : "get",
                    url : url
                }).then(function mySuccess(response) {
                    $scope.prounionList = response.data;

                }, function myError(response) {
                    $scope.myWelcome = response.statusText;
                });

            };

            $scope.getVillage = function(){
                $scope.voteKendroList = [];
                if(angular.isUndefined($scope.pourosova)){
                    return ;
                }
                var url = "{{ route('forVillage') }}/" + $scope.pourosova.id;
                $http({
                    method : "get",
                    url : url
                }).then(function mySuccess(response) {
                    $scope.VilageList = response.data;

                }, function myError(response) {
                    $scope.myWelcome = response.statusText;
                });
            };
            $scope.getData = function(){
                var submitInfo = {
                    nationalId:$scope.nationalId,
                    mobile:$scope.mobile,
                    upojela:"",
                    pourosova:"",
                    village:""

                };
                if(!angular.isUndefined($scope.upojela)){
                    submitInfo.upojela = $scope.upojela.upzila_name;
                }
                if(!angular.isUndefined($scope.pourosova)){
                    submitInfo.pourosova = $scope.pourosova.name;
                }
                if(!angular.isUndefined($scope.village)){
                    submitInfo.village = $scope.village.village_name;
                }

                $http({
                    method : "post",
                    url : '{{ route('searchResult') }}',
                    data: JSON.stringify(submitInfo)
                }).then(function mySuccess(response) {

                    if(response.data.success==true){
                        $scope.voterData = response.data.info;
                    }else{
                        alert(response.data.message);
                        $scope.voterData = [];
                    }

                }, function myError(response) {
                    $scope.myWelcome = response.statusText;
                });
            };



        });
    </script>
@endsection

@section("style")
    <style>
        .pwn{
            border: 2px solid black ;
            display: inline;

        }
    </style>
    @endsection
