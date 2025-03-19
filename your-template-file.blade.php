<div class="row">
    <div class="col-xl-12">
        <div style="min-height: 500px" class="ps-widget bgc-white bdrs12 default-box-shadow2 pt30 mb30 overflow-hidden position-relative">
            <div class="navtab-style1">
                <!-- Tab headers remain unchanged -->
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <!-- ... existing tab buttons ... -->
                    </div>
                </nav>
                
                <!-- Tab content -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- ... your existing tab panels without the navigation buttons ... -->
                </div>

                <!-- Single set of navigation buttons outside tab panels -->
                <div class="justify-content-between d-flex p-3" id="tab-navigation">
                    <button class="ud-btn btn-thm" type="button" id="prevTab" onclick="switchTabs('prev')">
                        <i class="fa fa-arrow-left"></i> {{__('Back')}}
                    </button>
                    <button class="ud-btn btn-thm" type="button" id="nextTab" onclick="switchTabs('next')">
                        {{__('Next')}} <i class="fa fa-arrow-right"></i>
                    </button>
                    <button class="ud-btn btn-thm d-none" id="submitBtn" type="submit">
                        {{__('agent.Submit Property')}} <i class="fal fa-arrow-right-long"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this JavaScript to handle navigation -->
<script>
function switchTabs(direction) {
    const activeTab = document.querySelector('.nav-link.active');
    const tabId = activeTab.id;
    const currentNum = parseInt(tabId.replace('nav-item', '').replace('-tab', ''));
    
    let nextNum;
    if (direction === 'next') {
        nextNum = currentNum + 1;
    } else if (direction === 'prev') {
        nextNum = currentNum - 1;
    }

    if (nextNum >= 1 && nextNum <= 7) {
        document.querySelector(`#nav-item${nextNum}-tab`).click();
    }

    // Update button visibility
    const prevBtn = document.getElementById('prevTab');
    const nextBtn = document.getElementById('nextTab');
    const submitBtn = document.getElementById('submitBtn');

    prevBtn.style.display = nextNum === 1 ? 'none' : 'block';
    nextBtn.style.display = nextNum === 7 ? 'none' : 'block';
    submitBtn.classList.toggle('d-none', nextNum !== 7);
}

// Initialize button visibility
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('prevTab').style.display = 'none';
});
</script>
