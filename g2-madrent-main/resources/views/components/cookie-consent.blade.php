@if ($showContainer == "false")
    <div id="cookiePopup">
@else
    <div id="cookiePopup" class="hidden">
@endif
    <style>
        #cookiePopup{
            position: fixed;
            z-index: 1100;
            background-color: red;
            color: white;
            padding: 20px;
            top: 0px;
            box-sizing: border-box;
        }
        .hidden{
            display: none !important;
        }
    </style>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    I am a very big cookie popup.
    
    <a href="{{Request::url()}}">Accept cookies</a>
</div>