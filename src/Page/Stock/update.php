<form action="#" method="POST" class="form">
    <label for="input-gstation">Gas Station:</label>
    <select name="gstation" id="input-gstation" class="form__select">
        <option value="1">Pumpa A</option>
        <option value="2">Pumpa B</option>
        <option value="3">Pumpa C</option>
    </select>
    <label for="input-fuel">Fuel:</label>
    <select name="fuel" id="input-fuel" class="form__select">
        <option value="1">Benzin95</option>
        <option value="2">Benzin98</option>
        <option value="3">Dizel</option>
        <option value="4">Plin</option>
    </select>
    <label for="input-amount">Amount:</label>
    <input type="number" name="amount" class="form__input" id="input-amount" value="0" min="0" max="10000">
    <input type="submit" name="submit-update" value="Update">
</form>