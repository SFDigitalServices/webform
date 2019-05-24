<div class="hidden cloneable addCalculationContainer">
  <div class="addCalculation">
    <a href="javascript:void(0)" onclick="javascript:addCalculation()">+Add A Calculation</a>
  </div>
</div>
<div class="hidden clonable firstCalculation">
    <label class="control-label calculationLabel">Calculation</label>
  <select class="allMathIds calculationId"></select>
</div>
<div class="hidden clonable calculationContainer">
  <div class="calculation">
    <i class="fas fa-minus-circle conditionIcon" onclick="javascript:removeCalculation(this)"></i>
    <select class="calculationOperator">
      <option>Plus</option>
      <option>Minus</option>
      <option>Multiplied by</option>
      <option>Divided by</option>
    </select>
    <select class="allMathIds calculationId"></select>
  </div>
</div>