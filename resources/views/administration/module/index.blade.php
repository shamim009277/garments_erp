<x-app-layout>
    @slot('title', 'Administration')
    <x-breadcrumb
        title="Administration"
        subtitle="Module"
            :right="[
            ['label' => 'Administration', 'url' => '/administration'],
            ['label' => 'Module', 'url' => '/administration/module'],
        ]" />

    <!--end breadcrumb-->

   <div class="row">
      <div class="col-lg-12  mx-auto">
          <h4 class="text-center">Module</h4>
      </div>
   </div>
    <div class="row">
        <div class="col-lg-12  mx-auto">
            <div class="card border-top border-0 border-2 border-primary">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</x-app-layout>
