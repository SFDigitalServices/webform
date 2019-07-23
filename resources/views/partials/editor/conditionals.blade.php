<div class="hidden clonable addConditionalContainer">
  <div class="addConditional" style="">
    <a href="javascript:void(0)" onclick="javascript:addConditional()">+Add A Condition</a>
  </div>
</div>

<div class="hidden clonable firstConditional">
  <select class="showHide">
    <option>Show</option>
    <option>Hide</option>
  </select>
</div>

<div class="hidden clonable multipleConditionals">
  <select class="allAny">
    <option>All</option>
    <option>Any</option>
  </select>
</div>

<div class="hidden clonable conditional">
  <div class="condition">
    <i class="fas fa-minus-circle conditionIcon" onclick="javascript:removeConditional(this)"></i>
    <span class="conditionalLabel"></span>
    <select class="allIds conditionalId">
    </select>
    <select class="conditionalOperator" onchange="javascript:conditionalSelect(this)">
      <option>matches</option>
      <option>doesn't match</option>
      <option>is less than</option>
      <option>is more than</option>
      <option>contains</option>
      <option>doesn't contain</option>
      <option>contains anything</option>
      <option>is blank</option>
    </select>
    <input type="text" class="form-control conditionalValue" />
  </div>
</div>