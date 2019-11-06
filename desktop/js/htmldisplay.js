
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

editorDashboardHtml = null;
editorMobileHtml = null;

$('a[data-toggle="tab"][href="#mobiletab"]').on('shown.bs.tab', function (e) {
  if (editorMobileHtml == null) {
    editorMobileHtml = CodeMirror.fromTextArea(document.getElementById("ta_mobilehtmldisplay"), {
      lineNumbers: true,
      mode: "text/html",
      matchBrackets: true,
      viewportMargin: Infinity
    });
    h = $(window).height() - ($('header.navbar').height() + $('#div_pageContainer').height()) + 50;
    editorMobileHtml.setSize(null, h);
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
    h = $(window).height() - ($('header.navbar').height() + $('#div_pageContainer').height()) + 50;
    editorDashboardHtml.setSize(null, h);
  }
});
