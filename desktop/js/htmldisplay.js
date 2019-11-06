
/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

var editorDashboardHtml = null;
var editorMobileHtml = null;
var htmldisplayContent = null;

$('a[data-toggle="tab"][href="#mobiletab"]').on('shown.bs.tab', function (e) {
  if (editorMobileHtml == null) {
    editorMobileHtml = CodeMirror.fromTextArea(document.getElementById("ta_mobilehtmldisplay"), {
      lineNumbers: true,
      mode: "text/html",
      matchBrackets: true,
      viewportMargin: Infinity
    });
    if(htmldisplayContent != null){
      editorMobileHtml.getDoc().setValue(htmldisplayContent.mobile);
      editorMobileHtml.refresh();
    }
  }
});

$('a[data-toggle="tab"][href="#dashboardtab"]').on('shown.bs.tab', function (e) {
  if (editorDashboardHtml == null) {
    editorDashboardHtml = CodeMirror.fromTextArea(document.getElementById("ta_dashboardhtmldisplay"), {
      lineNumbers: true,
      mode: "text/html",
      matchBrackets: true,
      viewportMargin: Infinity
    });
    if(htmldisplayContent != null){
      editorDashboardHtml.getDoc().setValue(htmldisplayContent.dashboard);
      editorDashboardHtml.refresh();
    }
  }
});

function saveEqLogic(_eqLogic){
  var mobile = '';
  if(editorMobileHtml != null){
    mobile = editorMobileHtml.getValue()
  }
  var dashboard = '';''
  if(editorDashboardHtml != null){
    dashboard = editorDashboardHtml.getValue()
  }
  $.ajax({
    type: "POST",
    url: "plugins/htmldisplay/core/ajax/htmldisplay.ajax.php",
    data: {
      action: "saveHtmlDisplay",
      id: _eqLogic.id,
      mobile: mobile,
      dashboard: dashboard,
    },
    dataType: 'json',
    error: function (request, status, error) {
      handleAjaxError(request, status, error);
    },
    success: function (data) {
      
    }
  });
  return _eqLogic;
}

function printEqLogic(_eqLogic){
  $.ajax({
    type: "POST",
    url: "plugins/htmldisplay/core/ajax/htmldisplay.ajax.php",
    data: {
      action: "getHtmlDisplay",
      id: _eqLogic.id,
    },
    dataType: 'json',
    error: function (request, status, error) {
      handleAjaxError(request, status, error);
    },
    success: function (data) {
      htmldisplayContent = data.result;
      if (editorDashboardHtml != null) {
        editorDashboardHtml.getDoc().setValue(data.result.dashboard);
        setTimeout(function () {
          editorDashboardHtml.refresh();
        }, 1);
      }
      if (editorMobileHtml != null) {
        editorMobileHtml.getDoc().setValue(data.result.mobile);
        setTimeout(function () {
          editorMobileHtml.refresh();
        }, 1);
      }
    }
  });
}
