<style>
    html,body { min-width: 320px; background-color: #EDEFF0 }
    nav {background-color:#0072FF}
    h1,h2,h3,h4,h5,h6 { font-weight: 300 }
    h4.main-title { margin: 0 0 25px 0 }
    h5.main-title { font-size:16px; letter-spacing:1px; font-weight: 500; text-transform:uppercase; margin: 10px 0 20px 0 }
    h6.main-title { font-size:14px; letter-spacing:1px; font-weight: 500; text-transform:uppercase; margin: 0 0 5px 0 }
    .card { box-shadow: 0 14px 20px 2px rgba(0, 0, 0, 0.06), 0 4px 20px 4px rgba(0, 0, 0, 0.04), 0 6px 8px -4px rgba(0, 0, 0, 0.02) }
    @font-face {
        font-family: 'Material Icons';
        font-style: normal;
        font-weight: 400;
        src: local('Material Icons'),
        local('MaterialIcons-Regular'),
        url("/fonts/MaterialIcons-Regular.woff2") format('woff2'),
        url("/fonts/MaterialIcons-Regular.woff") format('woff'),
        url("/fonts/MaterialIcons-Regular.ttf") format('truetype');
    }

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
    .slate { background:#252e36 }
    .slate-text { color:#252e36 }
    .form-small { max-width: 330px; margin: 0 auto }
    form .chip { margin-top: -8px; margin-bottom: 16px }
    body { display: flex; min-height: 100vh; flex-direction: column }
    main { flex: 1 0 auto; padding-bottom: 30px; padding-top: 60px }
    nav { top: 0; position: fixed; z-index: 999 ; transition: top 0.25s ease-in-out; box-shadow: 0 0 25px 0 rgba(0,0,0,0.3); -moz-box-shadow: 0 0 25px 0 rgba(0,0,0,0.3); -webkit-box-shadow: 0 0 25px 0 rgba(0,0,0,0.3); }
    nav { background-color: #0072ff }
    .nav-up { top: -52px }
    .container.full { margin: 0 auto; width: 97%; padding: 0 8px;}
    .container > .row > .col > h4 { margin-top:0 }
    .col > .col { padding-left: 0; padding-right: 0 }
    .col.l4 h5.main-title:after { content:""; background: linear-gradient(to left, #00c6ff , #0072ff); height:3px; width:40px; display:block; margin: 10px 0 40px 0 }
    .main-content .card { margin-bottom: 1.75rem }
    .side-content p { padding-bottom: 1rem; border-bottom: 1px solid lightgrey }
    .side-content a.delete { color: lightgrey }
    .side-content a.delete:hover { color:red; text-decoration: none; cursor: pointer }
    .card .card-title, .card-panel .title { font-weight: 500}
    .btn-small { padding: 0 0.75rem }
    .modal { max-height: 80%}
    #datatable_filter input::placeholder { color:grey }
    .dataTables_wrapper label { font-size: 0.9em }
    .dataTables_wrapper .input-field > .select-wrapper { width: 100%; margin: 0 0 1rem; display: inline-block }
    @media only screen and (min-width: 993px) {
        .col.main-content { padding-right: 2rem }
    }
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
        .card-panel > a, .card-panel > form > button { float:none; width:100% }
        .btn { margin: 2px auto; padding: 0 0.75rem; height: 30px; line-height: 30px }
        /*.tooltipped { padding: 0 0.8rem; margin: 0 4px }*/
    }
</style>
