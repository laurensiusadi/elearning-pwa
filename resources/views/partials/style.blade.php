<style>
    html,body { min-width: 320px; background-color: #F4F6F9; /*color:#262f38*/}
    h1,h2,h3,h4,h5,h6 { font-weight: 500}
    .gradient-1 {
        background: #0575E6;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #021B79, #0575E6);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #021B79, #0575E6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
    .gradient-2 {
        background: #00c6ff; /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #00c6ff , #0072ff); /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #00c6ff , #0072ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
    .slate { background: #252e36; }
    .form-small { max-width: 330px; margin: 0 auto }
    form .chip { margin-top: -8px; margin-bottom: 16px }
    body { display: flex; min-height: 100vh; flex-direction: column }
    main { flex: 1 0 auto; padding-bottom: 50px; padding-top: 70px }
    nav { top: 0; position: fixed; z-index: 999 ; transition: top 0.25s ease-in-out; box-shadow: 0 0 10px 0 rgba(0,0,0,0.25); -moz-box-shadow: 0 0 10px 0 rgba(0,0,0,0.25); -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,0.25); }
    .nav-up { top: -52px }
    .card-panel > a.delete { color: lightgrey }
    .card-panel:hover a.delete { color:red; text-decoration: none; cursor: pointer }
    .card .card-title, .card-panel .title { font-weight: 500}
    .btn-small { padding: 0 0.75rem }
    .modal { max-height: 80%}
    #datatable_filter input::placeholder { color:grey }
    @media only screen and (max-width: 601px) {
        .nav-up { top: -44px }
        .btn i { font-size: 1rem }
        .btn-small { margin: 2px auto; padding: 0 0.5rem; height: 30px; line-height: 30px }
        table { border: 0; font-size: 13px }
        table thead { display: none }
        table tr { padding-bottom: 12px; margin-bottom: 12px; display: block; border-bottom: 2px solid #ddd }
        table td { display: block;  text-align: right;  font-size: 13px;  border-bottom: 1px dotted #ccc }
        table td:last-child { border-bottom: 0 }
        table td:before { content: attr(data-label); float: left; font-weight: bold }
        td .modal { text-align: left }
        #datatable_wrapper > .row > div { float:none; width:100% }
        #datatable_filter input { margin: 8px auto 0; width: 94% }
        .card-panel > a, .card-panel > form > button { float:none; width:100% }
        .row > h4, .row > h5 { text-align: center }
        .btn { margin: 2px auto; padding: 0 0.5rem; height: 30px; line-height: 30px }
        /*.tooltipped { padding: 0 0.8rem; margin: 0 4px }*/
    }
</style>
