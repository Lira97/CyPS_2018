from selenium import webdriver
from selenium.webdriver.common.keys import Keys

driver = webdriver.Safari()
driver.get("http://blazedemo.com")


elemento = driver.find_element_by_name("fromPort")

opciones = elemento.find_elements_by_tag_name("option")

for opcion in opciones:
    if opcion.get_attribute("value") == "Mexico City":
        opcion.click()

button = driver.find_element_by_xpath("//input")
button.click()

mytable = driver.find_elements_by_xpath("//tr")

prices = mytable.find_element_by_xpath("//td")


for precio in mytable:
        print(price.get_attribute("value") )

#elemento.send_keys("San Diego")
#text.click(Keys.ENTER)
