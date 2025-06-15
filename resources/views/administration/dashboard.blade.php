<x-app-layout>
    @slot('title', 'Administration')
    <x-breadcrumb
        title="Dashboard"
        subtitle="Administration"
            :right="[
            ['label' => 'Administration', 'url' => '/administration'],
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
