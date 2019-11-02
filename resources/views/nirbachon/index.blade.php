@extends('layouts.app')

@section('content')
    <div class="row" ng-controller="temsSetupController">
        <div class="col-md-12">
            <form name="userForm" id="userform" ng-submit="submitForm(userForm.$valid)" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">নাম<span class="mandatory">*</span></label>
                            <span id="userId" style="display:none">{{ Auth::user()->id }}</span>
                            <span id="usertype" style="display:none">{{ Auth::user()->usertype }}</span>
                            <span id="upozilaName" style="display:none">{{ Auth::user()->upojela }}</span>
                            <span id="pouraName" style="display:none">{{ Auth::user()->pourosova }}</span>
                            <input type="text" bangla-only name="name" required ng-model="name" class="form-control">
                            <p ng-show="userForm.name.$invalid && !userForm.name.$pristine" class="help-block">Your name is required.</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">পিতা / স্বামীর নাম<span class="mandatory">*</span></label>
                            <input type="text" bangla-only name="fathername" required ng-model="fathername" class="form-control">
                            <p ng-show="userForm.fathername.$invalid && !userForm.fathername.$pristine" class="help-block">Your father name is required.</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">লিঙ্গ <span class="mandatory">*</span></label>
                            <select class="form-control" required name="gender" ng-model="gender">
                                <option value=""></option>
                                <option>পুরুষ </option>
                                <option>মহিলা </option>
                            </select>
                            <p ng-show="userForm.gender.$invalid && !userForm.gender.$pristine" class="help-block">Gender is required.</p>
                        </div>
                        <div class="form-group">
                            <div class="form-row align-items-center">
                            <label for="exampleInputEmail1">মোবাইল নম্বর<span class="mandatory">*</span></label>
                            <input type="text" id="mobileNumber" name="mobileNumber" numbers-only minlength="11" maxlength="11"  required ng-model="mobileNumber" class="form-control">
                            <span style="color:red; display:none" id="mobinfo">সঠিক মোবাইল নং লিখুন</span>
                            <p ng-show="userForm.mobileNumber.$invalid && !userForm.mobileNumber.$pristine" class="help-block">Mobile number is required.</p>
                            </div>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputEmail1">জন্মসাল<span class="mandatory">*</span></label>
                            <input type="text" maxlength="4" minlength="4" numbers-only  id="birthYear" name="birthYear" ng-change="updateVoteNumber()" required ng-model="birthYear" class="form-control" placeholder="1900 থেকে 2000 এর মধ্যে জন্ম সাল লিখুন">
                            <span style="color:red; display:none" id="salinfo">1900 থেকে 2000 এর মধ্যে জন্ম সাল লিখুন</span>
                            <p ng-show="userForm.birthYear.$invalid && !userForm.birthYear.$pristine" class="help-block">Birth year required.</p> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">উপজেলা<span class="mandatory">*</span></label>
                            <select class="form-control" name="upojela" required ng-model="upojela" ng-change="getProunion()" ng-options="item.upzila_name for item in upozilaList">
                                <option value="">Select a Upojila</option>
                            </select>
                            <p ng-show="userForm.upojela.$invalid && !userForm.upojela.$pristine" class="help-block">Upojela required.</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">পৌরসভা / ইউনিয়ন<span class="mandatory">*</span></label>
                            <select class="form-control" name="pourosova"  required ng-model="pourosova" ng-change="getVillage()" ng-options="item.name for item in prounionList">
                                <option value="">Select a pourosova</option>
                            </select>
                            <p ng-show="userForm.pourosova.$invalid && !userForm.pourosova.$pristine" class="help-block">Pourosova required.</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">গ্রাম<span class="mandatory">*</span></label>
                            <select class="form-control" name="village" required ng-model="village" ng-change="getVotkenDro()" ng-options="item.village_name for item in VilageList">
                                <option value="">Select a village</option>
                            </select>
                            <p ng-show="userForm.village.$invalid && !userForm.village.$pristine" class="help-block">Village required.</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">ভোট কেন্দ্রের নাম<span class="mandatory">*</span></label>
                            <!-- <select class="form-control" name="votkendro" required ng-model="votkendro" ng-options="item.kendro_name for item in voteKendroList">
                                <option value="">Select a votkendro</option>
                            </select> -->
                            <input type="text" style="background-color:#2eb82e; font-weight:bold" name="votkendro" readonly="readonly" ng-model="votkendro"  class="form-control mytext">
                            <!-- <p ng-show="userForm.votkendro.$invalid && !userForm.votkendro.$pristine" class="help-block">votkendro required.</p> -->
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">জাতীয় পরিচয়পত্রের শেষ ৬  নম্বর<span class="mandatory">*</span></label>
                            <input type="text" maxlength="6" minlength="6" numbers-only ng-change="updateVoteNumber()" name="nationalIdLast" required ng-model="nationalIdLast"  class="form-control mytext">
                            <p ng-show="userForm.nationalIdLast.$invalid && !userForm.nationalIdLast.$pristine" class="help-block">National ID last required.</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">জাতীয় পরিচয়পত্র নম্বর</label>
                    <br>

                    <span style="font-size:24px; font-weight:bold;" class="pwn" ng-repeat="aNumber in nationalIdNumber track by $index"><% aNumber %></span>

                </div>
                <button type="submit" ng-disabled="userForm.$invalid" class="btn btn-success">Submit</button>
                <button class="btn btn-danger" id="clearButton">Clear</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
    <script src="{{ asset('js/angular.min.js') }}" ></script>
    <script>
        var tms = angular.module('tms', [], function ($interpolateProvider) {

        });
        tms.directive('numbersOnly', function () {
            return {
                require: 'ngModel',
                link: function (scope, element, attr, ngModelCtrl) {
                    function fromUser(text) {
                        if (text) {
                            var transformedInput = text.replace(/[^0-9]/g, '');

                            if (transformedInput !== text) {
                                ngModelCtrl.$setViewValue(transformedInput);
                                ngModelCtrl.$render();
                            }
                            return transformedInput;
                        }
                        return undefined;
                    }
                    ngModelCtrl.$parsers.push(fromUser);
                }
            };
        });
        
        tms.directive('banglaOnly', function () {
            return {
                require: 'ngModel',
                link: function (scope, element, attr, ngModelCtrl) {
                    function fromUser(text) {
                        if (text) {
                            var transformedInput = text.replace(/[a-z0-9<,>.?/:;"'|~`!@#$=+_-]|[)\]\(\{\}\[\]\%\^&*\\]/gi, '');

                            if (transformedInput !== text) {
                                ngModelCtrl.$setViewValue(transformedInput);
                                ngModelCtrl.$render();
                            }
                            return transformedInput;
                        }
                        return undefined;
                    }
                    ngModelCtrl.$parsers.push(fromUser);
                }
            };
        });
        tms.config(function ($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });
        debugger;
        var userType = parseInt($('#usertype').text());
        tms.controller('temsSetupController', function temsSetupController($scope, $http) {
            $scope.nationalIdNumber = [0,0,0,0,4,1,0,0,0,0,0,0,0,0,0,0,0];
            $scope.upozilaList = [];
            $scope.prounionList = [];
            $scope.VilageList = [];
            $scope.voteKendroList = [];
            $http({
                method : "get",
                url : '{{ route('forUpojila') }}'
            }).then(function mySuccess(response) {
                // change start
                debugger;
                if(userType ==2){
                    $scope.upozilaList =  [response.data.find(o => o.upzila_name === $('#upozilaName').text())];
                 }else if(userType ==1){
                    $scope.upozilaList = response.data;
                 }
                $scope.updateVoteNumber();

            }, function myError(response) {
                $scope.myWelcome = response.statusText;
            });

            $scope.getProunion = function(){
                debugger;
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

                    // change start
                    if(userType ==2){
                    $scope.prounionList =  [response.data.find(o => o.name === $('#pouraName').text())];
                    }
                    // change end
                    else if(userType ==1){
                     $scope.prounionList = response.data;
                    }
                    $scope.updateVoteNumber();

                }, function myError(response) {
                    $scope.myWelcome = response.statusText;
                });

            };
            
           // $scope.nn = {{Auth::user()->upojela}}; // ######################################
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
                    $scope.updateVoteNumber();

                }, function myError(response) {
                    $scope.myWelcome = response.statusText;
                });
            };

            $scope.getVotkenDro = function(){
                $scope.voteKendroList = [];
                if(angular.isUndefined($scope.village)){
                    alert("its undefined");
                    return ;
                }
                var url = "{{ route('forVotkendro') }}/" + $scope.village.id;
                $http({
                    method : "get",
                    url : url
                }).then(function mySuccess(response) {
                    debugger;
                    console.log(response.data);
                    $scope.voteKendroList = response.data;
                    $scope.votkendro=response.data[0].kendro_name;
                    //$scope.votkendro.kendro_name=$scope.votkendro2;
                    $scope.updateVoteNumber();

                }, function myError(response) {
                    $scope.myWelcome = response.statusText;
                });
            };
            
            $scope.submitForm = function(isValid) {
                debugger;
                // votkendro:$scope.votkendro.kendro_name,
                // check to make sure the form is completely valid
                $scope.userId = $('#userId').text();
                if (isValid) {
                    debugger;
                    var submitInfo = {
                        name : $scope.name,
                        userId : $scope.userId,
                        father_name:$scope.fathername,
                        gender : $scope.gender,
                        division:"KHULNA",
                        district:"JESSORE",
                        upazila:$scope.upojela.upzila_name,
                        is_union:$scope.pourosova.is_union,
                        up_or_pouro_name:$scope.pourosova.name,
                        villege:$scope.village.village_name,
                        votkendro:$scope.votkendro,
                        national_id:$scope.nationalIdNumber.join(""),
                        mobile_no:$scope.mobileNumber,
                    };
                    $http({
                        method : "post",
                        url : '{{ route('saveVoter') }}',
                        data: JSON.stringify(submitInfo)
                    }).then(function mySuccess(response) {
                        alert(response.data.message);
                        console.log(response.data.mysms);
                        if(response.data.success==true){

                            window.location.reload();
                        }else{

                        }

                    }, function myError(response) {
                        $scope.myWelcome = response.statusText;
                    });
                }
            };
            $scope.updateVoteNumber = function () {


                if($scope.birthYear !=null && $scope.birthYear.toString().length==4){
                    var info = $scope.birthYear.toString();
                    $scope.nationalIdNumber[0]= info[0];
                    $scope.nationalIdNumber[1]= info[1];
                    $scope.nationalIdNumber[2]= info[2];
                    $scope.nationalIdNumber[3]= info[3];
                }else{
                    $scope.nationalIdNumber[0]= 0;
                    $scope.nationalIdNumber[1]= 0;
                    $scope.nationalIdNumber[2]= 0;
                    $scope.nationalIdNumber[3]= 0;
                }

                if($scope.upojela!=null){
                    var nowUpojilaId = $scope.upojela.upozila_gov_id.toString();
                    $scope.nationalIdNumber[7]= nowUpojilaId[0];
                    $scope.nationalIdNumber[8]= nowUpojilaId[1];
                }else{
                    $scope.nationalIdNumber[7]= 0;
                    $scope.nationalIdNumber[8]= 0;
                }

                if($scope.pourosova !=null){
                    if($scope.pourosova.is_union==1){
                        $scope.nationalIdNumber[6]= 1;
                    }else{
                        $scope.nationalIdNumber[6]= 2;
                    }
                }else{
                    $scope.nationalIdNumber[6]= 0;
                }
                if($scope.nationalIdLast !=null && $scope.nationalIdLast.length==6){
                    var myData= $scope.nationalIdLast;
                    var count = 11;
                    for (let i = 0; i < myData.length; i++) {
                        $scope.nationalIdNumber[count] = myData.charAt(i);
                        count++;
                    }

                }else{
                    for (let i = 11; i <=16 ; i++) {
                        $scope.nationalIdNumber[i] = 0;
                    }
                }

                if($scope.village !=null){
                    if($scope.pourosova.is_union==1){
                        var prounionData = $scope.pourosova.union_pouro_gov_id.toString();
                        $scope.nationalIdNumber[9] = prounionData[0];
                        $scope.nationalIdNumber[10] = prounionData[1];
                    }else{
                        var villagewardIds = $scope.village.ward_if_pouro.toString();
                        if(villagewardIds.length==1){
                            villagewardIds = "0"+ villagewardIds;
                        }
                        $scope.nationalIdNumber[9] = villagewardIds[0];
                        $scope.nationalIdNumber[10] = villagewardIds[1];

                    }
                }

            };
          
        });
        // clearButton
        $( "#clearButton" ).click(function() {
            debugger;
            $("#userform")[0].reset();
            //location.reload();
        });
        $("#birthYear").on("blur",  function() { 
            var birthval = $("#birthYear").val();
            if(birthval<1900 || birthval>2000){
                $("#salinfo").css("display", "block");
                $("#birthYear").val("");
                return;
            }else{
                $("#salinfo").css("display", "none");   
            }
        });

        $("#mobileNumber").on("blur",  function() { 
            var mobileNo = $("#mobileNumber").val();
            var pattern = /^(01){1}[5-9]{1}\d{8}$/;
            if (!pattern.test(mobileNo)) {
                $("#mobinfo").css("display", "block");
                //$("#mobileNumber").val("");
                return false;
            }
            else{
                $("#mobinfo").css("display", "none");   
            }
        });
    </script>
@endsection

@section("style")
    <style>
        .pwn{
            border: 2px solid black ;
            display: inline;

        }
        .mandatory{
            color:red;
        }
        .help-block{
            color:red;
        }
    </style>
    @endsection
