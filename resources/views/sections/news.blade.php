<!-- News Section -->
<section class="HomeNews">
    <div class="HomeNews-inner u-frame">
        <div class="u-flex u-flexJustifyBetween u-flexAlignItemsCenter">
            <h2>Aktuality</h2>
            <div class="HomeNews-buttons u-flex">
                <x-button size="small" variant="icon" class="HomeNews-button" disabled>
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                </x-button> 
                <x-button size="small" variant="icon" class="HomeNews-button">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                </x-button>             
            </div>
        </div>
        <div class="HomeNews-new u-flex">            
            <figure class="HomeNews-image">
                <img src="@asset('news.png')" alt="London"> 
            </figure>           
            <div>
              <span class="u-note">29. 5. 2023 | ESG</span>
              <h5>Best Practice in Creating Social Value Beyond London</h5>
              <p>Connection content share edit hand. Share shadow edit team arrange flows mask italic effect. Bullet stroke scrolling selection pixel opacity vector subtract arrange. Rectangle layer figjam variant text edit ipsum ellipse fill frame. Draft mask component follower create flows figma rectangle.</p> 
              <x-button href="#" variant="alternative">
                <svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 6H10V0H4V6H0L7 13L14 6ZM6 8V2H8V8H9.17L7 10.17L4.83 8H6ZM0 15H14V17H0V15Z" fill="#EC6C00"/>
                </svg>
                <span>Stáhnout výroční zprávu</span>
              </x-button>
            </div> 
        </div>
        <div class="u-flex u-flexJustifyCenter u-flexAlignItemsCenter">
            <a href="#" class="Button Button--primary">
                <span>Všechny&nbsp;aktuality</span>
            </a>
        </div>
    </div>
</section>