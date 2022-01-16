@extends('app')
@section('content')
    @include('landing.header')

    <section class="terms-section pt-120 pb-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 pb-30">
                    <div class="authentication-item">
                        <h3>{{__('content.Terms of registration')}}</h3>
                        <div class="authentication-form">

                           <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group mb-20">
                                        <label for="">1. {{__('content.Registration is limited to students of partner schools with Bawsalati')}}</label>
                                    </div>
                               </div>
                           </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-20">
                                        <label for="">2. {{__('content.Obey Qatar laws and school roles and regulations')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-20">
                                        <label for="">3. {{__('content.Maintain a GBA higher than 2.5 or 75% semester total grade')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-20">
                                        <label for="">4. {{__('content.Commit to attending activities on time')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-20">
                                        <label for="">5. {{__('content.Attend one-on-one meetings and group meetings with the cluster leader')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-20">
                                        <label for="">6. {{__('content.Follow organizers’ guidelines')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-20">
                                        <label for="">7. {{__('content.Respect all organizers and all participants')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-20">
                                        <label for="">8. {{__('content.Avoid any behavior that my impact the reputation of school or Bawsalati')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-20">
                                        <label for="">9. {{__('content.Participate on the initiatives of the team')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-20">
                                        <label for="">10. {{__('content.Do not misuse participant’s privileges and resources')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('landing.footer')
@endsection
