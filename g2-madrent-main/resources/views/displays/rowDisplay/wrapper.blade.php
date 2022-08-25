<div class="displayRow firstRow row overflow-hidden">
    {{-- <div class="controls">
        <div class="controlLeft"><</div>
        <div class="controlRight">></div>
    </div> --}}
    @include('displays.rowDisplay.product', ['id' => '1', 'img' => 'GPUs/3090FE.jpg', 'name' => 'RTX 3090 24GB Founders Edition', 'price' => '25.99'])
    @include('displays.rowDisplay.product', ['id' => '2', 'img' => 'GPUs/2080tiFE.jpg', 'name' => 'RTX 2080TI 16GB Founders Edition', 'price' => '27.99'])
    @include('displays.rowDisplay.product', ['id' => '3', 'img' => 'GPUs/A6000.jpg', 'name' => 'RTX A6000 24GB', 'price' => '26.99'])
    @include('displays.rowDisplay.product', ['id' => '1', 'img' => 'picPlaceholder.png', 'name' => 'RTX 3090 48GB Founders Edition', 'price' => '255.99'])
</div>