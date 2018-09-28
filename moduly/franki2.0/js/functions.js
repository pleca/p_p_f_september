
$(document).ready(function () {
  $('#franc_calculator').kendoTabStrip({
    animation: {
      open: {
        effects: 'fadeIn',
      },
    },
  })
  $('#commission_calculator').kendoTabStrip({
    animation: {
      open: {
        effects: 'fadeIn',
      },
    },
  })
  $('#contract').kendoTabStrip({
    animation: {
      open: {
        effects: 'fadeIn',
      },
    },
  })

  $('#contract-list').kendoTabStrip({
    animation: {
      open: {
        effects: 'fadeIn',
      },
    },
  })

  $('#documents').kendoTabStrip({
    animation: {
      open: {
        effects: 'fadeIn',
      },
    },
  })


  $("#printContractFrankWindow").kendoWindow({
        width: "30%",
        modal: true,
        minWidth: 100,
        visible: false,
        position: {
            top: 100,
            left: "34%"
        }
    }).data("kendoWindow");

})
