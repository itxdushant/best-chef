@extends('layouts.coming-soon')
<style>
      body{
          margin: 0px;
          padding: 0px;
      }
      .coming-soon-inner-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.coming_soon-cntnt {
    text-align: center;
	 max-width: 694px;
}
.coming_soon-cntnt>h2 {
    font-size: 42px;
    text-transform: uppercase;
    font-weight: 700;
    margin-top: 0px;
    margin-bottom: 0px;
}
.coming_soon-cntnt>h3 {
    font-size: 22px;
    font-weight: 300;
    color: grey;
    margin-top: 10px;
    margin-bottom: 0px;
}
.coming_soon-cntnt .logo-image img {
    width: 100%;
    max-width: 285px;
    margin: 0 auto;
}
.coming_soon-cntnt p
{
	font-family:'Open Sans', sans-serif;   
	text-align: center;  
    font-size: 18px;
    line-height: 27px;
}
  </style>
</head>
<body>
  <div class="coming_soon-wrapper">
      <div class="coming-soon-inner-wrap">
          <div class="coming_soon-cntnt">
              
              <div class="logo-image">
                  <img src="https://bestlocalchef.com/images/logo.png">
				 
              </div>
			   <p><strong>We’ve updated the Best Local Chef platform to adjust to customers and chefs during COVID-19. Our official re-launch will be September 4, 2020.
</strong></p>
          </div>
      </div>
  </div>
