<div class="label-primary" style="height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Ficha Clínica</div>

<style>
    .popup-box {
        background-color: #ffffff;
        bottom: 0;
        font-family: 'Open Sans', sans-serif;
    }
    .round.hollow {
        margin: 40px 0 0;
    }
    .round.hollow a {
        border: 2px solid #ff6701;
        border-radius: 35px;
        color: red;
        color: #ff6701;
        font-size: 23px;
        padding: 10px 21px;
        text-decoration: none;
        font-family: 'Open Sans', sans-serif;
    }
    .round.hollow a:hover {
        border: 2px solid #000;
        border-radius: 35px;
        color: red;
        color: #000;
        font-size: 23px;
        padding: 10px 21px;
        text-decoration: none;
    }
    .popup-box-on {
        display: block !important;
    }
    .popup-box .popup-head {
        background-color: #fff;
        clear: both;
        color: #7b7b7b;
        display: inline-table;
        font-size: 21px;
        padding: 7px 10px;
        width: 100%;
        font-family: Oswald;
    }
    .bg_none i {
        border: 1px solid #ff6701;
        border-radius: 25px;
        color: #ff6701;
        font-size: 17px;
        height: 33px;
        line-height: 30px;
        width: 33px;
    }
    .bg_none:hover i {
        border: 1px solid #000;
        border-radius: 25px;
        color: #000;
        font-size: 17px;
        height: 33px;
        line-height: 30px;
        width: 33px;
    }
    .bg_none {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
    }
    .popup-box .popup-head .popup-head-right {
        margin: 11px 7px 0;
    }
    .popup-box .popup-messages {
    }
    .popup-head-left img {
        border: 1px solid #7b7b7b;
        border-radius: 50%;
        width: 44px;
    }
    .popup-messages-footer > textarea {
        border-bottom: 1px solid #b2b2b2 !important;
        height: 34px !important;
        margin: 7px;
        padding: 5px !important;
        border: medium none;
        width: 95% !important;
    }
    .popup-messages-footer {
        background: #fff none repeat scroll 0 0;
        bottom: 0;
        position: absolute;
        width: 100%;
    }
    .popup-messages-footer .btn-footer {
        overflow: hidden;
        padding: 2px 5px 10px 6px;
        width: 100%;
    }
    .simple_round {
        background: #d1d1d1 none repeat scroll 0 0;
        border-radius: 50%;
        color: #4b4b4b !important;
        height: 21px;
        padding: 0 0 0 1px;
        width: 21px;
    }

    .popup-box .popup-messages {
        overflow: auto;
    }
    .direct-chat-messages {
        overflow: auto;
        padding: 10px;
        transform: translate(0px, 0px);

    }
    .popup-messages .chat-box-single-line {
        border-bottom: 1px solid #a4c6b5;
        height: 12px;
        margin: 7px 0 20px;
        position: relative;
        text-align: center;
    }
    .popup-messages abbr.timestamp {
        background: #337ab7 none repeat scroll 0 0;
        color: #fff;
        padding: 0 11px;
    }

    .popup-head-right .btn-group {
        display: inline-flex;
        margin: 0 8px 0 0;
        vertical-align: top !important;
    }
    .chat-header-button {
        background: transparent none repeat scroll 0 0;
        border: 1px solid #636364;
        border-radius: 50%;
        font-size: 14px;
        height: 30px;
        width: 30px;
    }
    .popup-head-right .btn-group .dropdown-menu {
        border: medium none;
        min-width: 122px;
        padding: 0;
    }
    .popup-head-right .btn-group .dropdown-menu li a {
        font-size: 12px;
        padding: 3px 10px;
        color: #303030;
    }

    .popup-messages abbr.timestamp {
        background: #337ab7  none repeat scroll 0 0;
        color: #fff;
        padding: 0 11px;
    }
    .popup-messages .chat-box-single-line {
        border-bottom: 1px solid #a4c6b5;
        height: 12px;
        margin: 7px 0 20px;
        position: relative;
        text-align: center;
    }
    .popup-messages .direct-chat-messages {
        height: auto;
    }
    .popup-messages .direct-chat-text {
        background: #dfece7 none repeat scroll 0 0;
        border: 1px solid #dfece7;
        border-radius: 2px;
        color: #1f2121;
    }

    .popup-messages .direct-chat-timestamp {
        color: #000;
        opacity: 0.6;
        font-size: 12px;
        float: left !important;
        padding-left: 35px;
        /*width: 200px;*/
    }

    .popup-messages .direct-chat-name {
        font-size: 15px;
        font-weight: 600;
        margin: 0 0 0 49px !important;
        color: #fff;
        opacity: 0.9;
    }
    .popup-messages .direct-chat-info {
        display: block;
        font-size: 12px;
        margin-bottom: 0;
    }
    .popup-messages  .big-round {
        margin: -9px 0 0 !important;
    }
    .popup-messages  .direct-chat-img {
        border: 2px solid #d4d0d0;
        background: #3f9684  none repeat scroll 0 0;
        border-radius: 50%;
        float: left;
        height: 40px;
        /*margin: -21px 0 0;*/
        width: 40px;
        cursor: pointer;
    }
    .direct-chat-reply-name {
        color: #000;
        font-size: 13px;
        margin: 0 0 0 10px;
        opacity: 0.9;
    }

    .direct-chat-img-reply-small
    {
        border: 1px solid #fff;
        border-radius: 50%;
        float: left;
        height: 20px;
        margin: 0 8px;
        width: 20px;
        background:#337ab7;
        cursor: pointer;
    }

    .popup-messages .direct-chat-msg {
        margin-bottom: 10px;
        position: relative;
    }

    .popup-messages .doted-border::after {
        background: transparent none repeat scroll 0 0 !important;
        border-right: 2px dotted #337ab7 !important;
        bottom: 0;
        content: "";
        left: 17px;
        margin: 0;
        position: absolute;
        top: 0;
        width: 2px;
        display: inline;
        z-index: -2;
    }

    .popup-messages .direct-chat-msg::after {
        background: #fff none repeat scroll 0 0;
        border-right: medium none;
        bottom: 0;
        content: "";
        left: 17px;
        margin: 0;
        position: absolute;
        top: 0;
        width: 2px;
        display: inline;
        z-index: -2;
    }
    .direct-chat-text::after, .direct-chat-text::before {

        border-color: transparent #dfece7 transparent transparent;

    }
    .direct-chat-text::after, .direct-chat-text::before {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: transparent #d2d6de transparent transparent;
        border-image: none;
        border-style: solid;
        border-width: medium;
        content: " ";
        height: 0;
        pointer-events: none;
        position: absolute;
        right: 100%;
        top: 15px;
        width: 0;
    }
    .direct-chat-text::after {
        border-width: 5px;
        margin-top: -5px;
    }
    .popup-messages .direct-chat-text {
        background: #dfece7 none repeat scroll 0 0;
        border: 1px solid #dfece7;
        border-radius: 2px;
        color: #1f2121;
    }
    .direct-chat-text {
        background: #d2d6de none repeat scroll 0 0;
        border: 1px solid #d2d6de;
        border-radius: 5px;
        color: #444;
        margin: 5px 0 0 50px;
        padding: 5px 10px;
        position: relative;
    }

    .popup-messages .direct-chat-img-active {
        border: 2px solid #ffa200;
    }

    @media (max-width: 1024px) {
        .direct-chat-reply-name{
            font-size: 10px;
            float: left !important;
            margin: 0px 0 0 10px;
            width: 85%;
        }
        .popup-messages .direct-chat-timestamp{
            font-size: 10px;
            padding-left: 11px;
        }
    }
</style>



@yield('listaTratamientos')

<div class="col-lg-9 contenedor" style="top: 35px;left: 25%;">
    <div id='contenidoFicha' class="bs_timeline_rigth" style="margin-top: 0px;border: 1px solid #D6D6D6;position: absolute;right: 0;left: 0;top: 0;bottom: 0; left: 0 !important; padding: 15px; overflow-y: scroll; background-color: #ffffff;">
        @yield('resumen_facturacion')
    </div>
</div>

</div>

<script>
    $(".direct-chat-img").click(function(){
        var pcp_id = $("#pcp_id").val();
        var esb_id = $("#establecimiento").val();
        $(".direct-chat-img").removeClass('direct-chat-img-active');
        $(this).addClass('direct-chat-img-active');
        if(this.id){
            $("#menu_tratamientos > li").removeClass("active");

            $(this).addClass("active");
            $("#contenidoFicha").load('fichaDetalle?pcp_id='+pcp_id+'&esb_id='+esb_id+'&epi_id='+this.id);

        }
    });
</script>