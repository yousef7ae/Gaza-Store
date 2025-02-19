<footer class="footer ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 footer-copyright">
                <p class="mb-0">{{__('Copyright')}} {{date('Y')}}
                    © {{($setting = \App\Models\Setting::where('name',"site_name")->first()) ? $setting->value : env('APP_NAME')}}
                    {{__('All rights reserved')}}.</p>
            </div>
        </div>
    </div>
</footer>

