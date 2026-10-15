<x-layout>
    <div class="container-fluid vh-100">
        <div class="row justify-content-center mt-5">
            <div class="col-12">
               
            <h1 class="fw-bold text-center mb-4">{{ __('ui.createArticleHeading') }}</h1>

            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-6">
               @livewire('create-article-form')
            </div>
        </div>
    </div>
</x-layout>