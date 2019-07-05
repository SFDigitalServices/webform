<div class="clickMenu">
  <ul>
    <span class="saveStatus"></span> 
    <i class="fas fa-circle-notch fa-spin saveSpinner" style="display:none;color:#aaa"></i>
    <li onkeydown="if(event.keyCode == 13) confirmAction('clone','doAction.php?action=clone')" onclick="javascript:confirmAction('clone','doAction.php?action=clone')" tabindex="0" data-toggle="tooltip" title="Clone"><i class="fas fa-clone"></i></li>
    <li onkeydown="if(event.keyCode == 13) confirmAction('delete','doAction.php?action=delete')" onclick="javascript:confirmAction('delete','doAction.php?action=delete')" tabindex="0" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></li>
    <li onkeydown="if(event.keyCode == 13) confirmAction('exit','editor.php')" onclick="javascript:confirmAction('exit','editor.php')" data-toggle="tooltip" tabindex="0" title="Exit"><i class="fas fa-sign-out-alt"></i></li>
  </ul>
</div>