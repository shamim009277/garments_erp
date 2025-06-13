<x-app-layout>
    @slot('title', 'Payrolls')
    <x-breadcrumb title="Dashboard" subtitle="Payroll" :right="[
        ['label' => 'Payroll', 'url' => '/payrolls'],
    ]" />

    <!--end breadcrumb-->


    <div class="row">
        <div class="col mx-auto">
            <div class="card border-top border-0 border-2 border-primary">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <!--end row-->

</x-app-layout>