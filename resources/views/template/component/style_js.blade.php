<!-- BEGIN: Vendor JS-->
<script src="{{ url('app-assets') }}/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ url('app-assets') }}/vendors/js/charts/apexcharts.min.js"></script>
<script src="{{ url('app-assets') }}/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ url('app-assets') }}/js/core/app-menu.js"></script>
<script src="{{ url('app-assets') }}/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
@if (Auth::user()->getAkses->id == 1)
    <script src="{{ url('app-assets') }}/js/scripts/pages/dashboard-ecommerce.js"></script>
@elseif (Auth::user()->getAkses->id == 2)
    <script src="{{ url('app-assets') }}/js/scripts/pages/dashboard-analytics.js"></script>
    <script src="{{ url('app-assets') }}/js/scripts/pages/app-invoice-list.js"></script>
@endif
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
