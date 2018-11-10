from selenium import webdriver
from selenium.webdriver.common.keys import Keys

browser = webdriver.Chrome()

browser.get('http://blazedemo.com/')

select = browser.find_element_by_name('fromPort')
options = select.find_elements_by_tag_name('option')

for option in options:
    if option.get_attribute('value') == "Mexico City":
        option.click()

select = browser.find_element_by_name('toPort')
options = select.find_elements_by_tag_name('option')

for option in options:
    if option.get_attribute('value') == "Paris":
        option.click()

browser.find_element_by_xpath('/html/body/div[3]/form/div/input').click()

table = browser.find_element_by_xpath('/html/body/div[2]/table/tbody')
prices = table.find_elements_by_tag_name('tr')

lower = None
lowerIndex = None
for i,price in enumerate(prices):
    rowPrice = browser.find_element_by_xpath('/html/body/div[2]/table/tbody/tr['+str(i+1)+']/td[6]').text
    if lower == None or rowPrice < lower:
        lower = rowPrice
        lowerIndex = i+1

browser.find_element_by_xpath('/html/body/div[2]/table/tbody/tr['+str(lowerIndex)+']/td[1]/input').click()


browser.find_element_by_name('inputName').send_keys("Enrique Lira")
browser.find_element_by_name('address').send_keys('Av division del norte')
browser.find_element_by_name('city').send_keys('Mexico ')
browser.find_element_by_name('state').send_keys('Mexico')
browser.find_element_by_name('zipCode').send_keys('05360')
browser.find_element_by_name('creditCardNumber').send_keys('5235422354233324')
browser.find_element_by_name('creditCardMonth').send_keys(Keys.BACK_SPACE+Keys.BACK_SPACE+'11')
browser.find_element_by_name('creditCardYear').send_keys(Keys.BACK_SPACE+Keys.BACK_SPACE+Keys.BACK_SPACE+Keys.BACK_SPACE+'2021')
browser.find_element_by_name('nameOnCard').send_keys('Enrique Lira')

browser.find_element_by_xpath('/html/body/div[2]/form/div[11]/div/input').click()
