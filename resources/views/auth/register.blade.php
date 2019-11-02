@extends('layouts.app')

@section('content')
<div class="container" ng-controller="temsSearchController">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fhname" class="col-md-4 col-form-label text-md-right">{{ __('Fathers/Husband Name') }}</label>

                            <div class="col-md-6">
                                <input id="fhname" type="text" class="form-control{{ $errors->has('fhname') ? ' is-invalid' : '' }}" name="fhname" value="{{ old('fhname') }}" required autofocus>

                                @if ($errors->has('fhname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fhname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('NID') }}</label>

                            <div class="col-md-6">
                                <input id="nid" type="text" class="form-control{{ $errors->has('nid') ? ' is-invalid' : '' }}" name="nid" value="{{ old('nid') }}" required>

                                @if ($errors->has('nid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fbid" class="col-md-4 col-form-label text-md-right">{{ __('Facebook ID') }}</label>

                            <div class="col-md-6">
                                <input id="fbid" type="text" class="form-control{{ $errors->has('fbid') ? ' is-invalid' : '' }}" name="fbid" value="{{ old('fbid') }}" required>

                                @if ($errors->has('fbid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fbid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="upojela" class="col-md-4 col-form-label text-md-right">Upojela</label>
                            <div class="col-md-6">
                            <!-- member.upzila_name as member.upzila_name for member in upozilaList track by member.upzila_name -->
                            <!-- item.upzila_name for item in upozilaList -->
                                <select class="form-control" name="upojela" required ng-model="upojela" ng-change="getProunion()" ng-options="member.upzila_name as member.upzila_name for member in upozilaList track by member.upzila_name">
                                <option value="">Select a Upojila</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pourosova" class="col-md-4 col-form-label text-md-right">Pourosova</label>
                            <div class="col-md-6">
                            <!-- member.name as member.name for member in prounionList track by member.name -->
                           <!--  item.name for item in prounionList -->
                            <select class="form-control" name="pourosova"  required ng-model="pourosova" ng-change="getVillage()" ng-options="member.name as member.name for member in prounionList track by member.name">
                                <option value="">Select a pourosova</option>

                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ward" class="col-md-4 col-form-label text-md-right">{{ __('Ward') }}</label>

                            <div class="col-md-6">
                                <input id="ward" type="text" class="form-control{{ $errors->has('ward') ? ' is-invalid' : '' }}" name="ward" value="{{ old('ward') }}" required autofocus>

                                @if ($errors->has('ward'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ward') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                debugger;
                $scope.upozilaList = response.data;


            }, function myError(response) {
                $scope.myWelcome = response.statusText;
            });

            $scope.getProunion = function(){
                debugger;
                $scope.prounionList = [];
                $scope.VilageList = [];
                $scope.voteKendroList = [];
                var result = $scope.upozilaList.find(o => o.upzila_name === $scope.upojela);
                $scope.upojlId = result.id;
                
                if(angular.isUndefined($scope.upojela)){
                    return ;
                }
                var url = "{{ route('forPourosova') }}/" + $scope.upojlId ;
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
                debugger;
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
