document.addEventListener('DOMContentLoaded', function() {
    /**
    * Add sticky-header to OCDI templates catalog
    */
    let navbar = document.getElementById('ocdi_gl-header')
  
    if ( navbar ) {
      window.addEventListener('scroll', function() {
        let sticky = navbar.offsetTop + 512
  
        if ( window.pageYOffset > sticky ) {
          navbar.classList.add('ocdi__gl-header_sticky')
          navbar.classList.remove("no-display")
        } else {
          navbar.classList.add("no-display")
          navbar.classList.remove("ocdi__gl-header_sticky")
        }
      })
    }
  
  
    /**
    * Remove update details when update theme
    */
    let updateDetails = document.getElementsByClassName('js-update-details-toggle')
  
    if(updateDetails[0]) { 
      updateDetails[0].innerHTML = null
    }
  
  
    /**
    * Add tooltip class to Header and Footer
    */
    let tooltipHeader = document.getElementById('main-header')
    let tooltipFooter = document.getElementById('footer-bottom')
  
    // If editor active
    let isEditorActive = false
    let htmlElement = document.getElementsByTagName("html")
    let htmlElementsArray = [...htmlElement]
  
    for (let i = 0; i < htmlElementsArray[0].classList.length; i++) {
      if (htmlElementsArray[0].classList[i] == 'et-fb-app-frame') isEditorActive = true
    }
  
    // tooltip to header
    if ( tooltipHeader && isEditorActive ) {
      tooltipHeader.classList.add("tooltip")
      tooltipHeader.innerHTML += '<button id="newTabHeaderButton" class="tooltiptext">Настроить</button>';
  
      newTabHeaderButton.addEventListener('click', function() {
        let newTab = window.open('/wp-admin/admin.php?page=et_divi_options', '_blank');
        newTab.focus();
      }, false);
  
      window.addEventListener('scroll', function() {
        if (pageYOffset > 61) {
          newTabHeaderButton.style.cssText=`top: 13px !important;`
        } else newTabHeaderButton.style.cssText=``
      })
    }
  
    //tooltip to footer
    if ( tooltipFooter && isEditorActive ) {
      tooltipFooter.classList.add("tooltipf")
      tooltipFooter.innerHTML += '<button id="newTabFooterButton" class="tooltiptextf">Настроить</button>';
  
      newTabFooterButton.addEventListener('click', function() {
        let newTab = window.open('/wp-admin/admin.php?page=et_divi_options', '_blank');
        newTab.focus();
      }, false);
    }
  
  
    // Tooltip to custom header
    let tooltipCustomHeader = document.getElementById('tb-main-header')
    let classHeaderLayout = document.getElementsByClassName('et_header_layout-template-default')
  
  
    if (tooltipCustomHeader && isEditorActive && classHeaderLayout.length < 1) {
      tooltipCustomHeader.classList.add("tooltip")
      tooltipCustomHeader.innerHTML += '<button id="newTabCustomHeaderButton" class="tooltiptext">Настроить</button>'
      customHeaderId = document.getElementById('tb-header-layout')
  
      newTabCustomHeaderButton.addEventListener('click', function() {
        let newTab = window.open('/?post_type=et_header_layout&p='+ customHeaderId.value +'&et_fb=1&PageSpeed=off', '_blank')
        newTab.focus()
      }, false)
    }
  
    if (classHeaderLayout.length > 0) {
      tooltipCustomHeader.innerHTML += '<script>function closeEditorPage() {' +
      'window.top.close();' +
      '}</script> ' +
      '<div style="position:absolute;top:0;background:#6c2eb9;width:100%;height:32px">' +
      '<span onclick="closeEditorPage()" style="cursor:pointer;color:white;font-weight:700; position:absolute; top:4px; left:50%; margin-left: -12px;">Закрыть</span></div>'
    }
  
    // Tooltip to custom footer
    let tooltipCustomFooter = document.getElementById('tb-main-footer')
    let classFooterLayout = document.getElementsByClassName('et_footer_layout-template-default')
  
    if (tooltipCustomFooter && isEditorActive && classFooterLayout.length < 1) {
      tooltipCustomFooter.classList.add("tooltip")
      tooltipCustomFooter.innerHTML += '<button id="newTabCustomFooterButton" class="tooltiptext">Настроить</button>'
      customFooterId = document.getElementById('tb-footer-layout')
  
      newTabCustomFooterButton.addEventListener('click', function() {
        let newTab = window.open('/?post_type=et_footer_layout&p='+ customFooterId.value +'&et_fb=1&PageSpeed=off', '_blank')
        newTab.focus()
      }, false)
    }
  
    if (classFooterLayout.length > 0) {
      tooltipCustomFooter.innerHTML += '<script>function closeEditorPage() {' +
      'window.top.close();' +
      '}</script> ' +
      '<div style="position:absolute;top:0;background:#6c2eb9;width:100%;height:32px">' +
      '<span onclick="closeEditorPage()" style="cursor:pointer;color:white;font-weight:700; position:absolute; top:4px; left:50%; margin-left: -12px;">Закрыть</span></div>'
    }
  
  
    /**
    * Save Logo
    */
  
    //save new logo
    let getLogoSetButton = document.getElementById('divi_logo_set_button')
   
    if (getLogoSetButton) {
      getLogoSetButton.addEventListener( 'click', function() {
        let isSaveButtonExists = document.getElementsByClassName('media-button-select')[0]
        isSaveButtonExists.setAttribute("id", "save-logo-id")
        console.log(isSaveButtonExists)
  
        let getSaveButton = document.getElementById('save-logo-id')
        console.log(getSaveButton)
        if (getSaveButton) {
          getSaveButton.addEventListener('click', function() {
            let refreshPageAfterSaveSettings = document.getElementById('epanel-save-top')
            refreshPageAfterSaveSettings.click()
    
            setTimeout( function() {
              location.reload()
            }, 1500)
          }, false)
        }
      })
    }
   
    // reset logo
    let getResetLogoButton = document.getElementById('divi_logo_reset')
    if (getResetLogoButton) {
      getResetLogoButton.addEventListener('click', function() {
        let refreshPageAfterResetLogo = document.getElementById('epanel-save-top')
        refreshPageAfterResetLogo.click()
        setTimeout( function() {
          location.reload()
        }, 1500)
      })
    }
  
    // Video Help Popup
    setTimeout(() => {
      var videoPopupOverlay = document.createElement("div")
      var bodyClasses = document.querySelector('body')
      videoPopupOverlay.innerHTML = '<div class="body-blackout"></div>'
      document.body.appendChild(videoPopupOverlay)
  
      var videoPopupElement = document.createElement("div")
      videoPopupElement.innerHTML = 
            '<div id="video-element" class="popup-modal shadow">' +
              '<iframe width="650px" height="365px" src="https://www.youtube.com/embed/ZrLEdZdOL1g"></iframe>' +
              '<i class="fas fa-2x fa-times popup-modal__close"></i>' +
            '</div>'
      document.body.appendChild(videoPopupElement)
      const adminVideo = document.getElementById('wp-admin-bar-video')
      const bodyBlackout = document.querySelector('.body-blackout')
      const popupModal = document.querySelector('.popup-modal')
  
      if ( adminVideo ) {
        adminVideo.addEventListener( 'click', () => {
          bodyClasses.classList.add('body-noscroll-modal')
  
          bodyBlackout.classList.add('is-blacked-out')
          document.body.append(bodyBlackout)
  
          popupModal.classList.add('is--visible')
          document.body.append(popupModal)
        })
      }
   
      popupModal.querySelector('.popup-modal__close').addEventListener('click', () => {
        bodyClasses.classList.remove('body-noscroll-modal')
  
        popupModal.classList.remove('is--visible')
        document.body.append(popupModal)
        bodyBlackout.classList.remove('is-blacked-out')
        document.body.append(bodyBlackout)
      })
   
      bodyBlackout.addEventListener('click', () => {
        bodyClasses.classList.remove('body-noscroll-modal')
        
        popupModal.classList.remove('is--visible')
        document.body.append(popupModal)
        bodyBlackout.classList.remove('is-blacked-out')
        document.body.append(bodyBlackout)
      })
    }, 2000)
  })