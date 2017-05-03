<style>
    html,body { min-width: 320px; background-color: #F4F6F9; /*color:#262f38*/}
    h1,h2,h3,h4 { font-weight: 500}
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
    @media only screen and (min-width: 601px) { .nav-up { top: -44px } }
    .card-panel > a { display: none; color:red }
    .card-panel:hover a { display:block; text-decoration: none; cursor: pointer }
    .card .card-title { font-weight: 500}
</style>
