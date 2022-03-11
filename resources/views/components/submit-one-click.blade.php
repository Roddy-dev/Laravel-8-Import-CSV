<div x-data="{ disableSubmit: false, text: 'Submit'}">
    <x-button  @click="
        text = 'Loading Table';
        disableSubmit = true;
    "
        class="mt-4"
        x-text="text"
        x-bind:disabled="disableSubmit">
    </x-button>
</div>