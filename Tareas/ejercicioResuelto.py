from selenium import webdriver
from selenium.webdriver import ActionChains

driver = webdriver.Safari()

driver.get("https://www.w3schools.com/default.asp")

"""
image_2_drag = driver.find_element_by_xpath('//*[@id="drag1"]')
element_2_put = driver.find_element_by_css_selector('#div2')

actions = ActionChains(driver)
actions.drag_and_drop(image_2_drag,element_2_put)
actions.click(element_2_put)
actions.release()
actions.perform()
actions.pause(2)
"""

menu = driver.find_element_by_xpath('//*[@id="navbtn_references"]')
subMenu = driver.find_element_by_xpath('/html/body/nav[3]/div/div[1]/a[1]')
actions = ActionChains(driver)
actions.click(menu)
actions.click(subMenu)
actions.pause(4)
actions.perform()

driver.back()

menu = driver.find_element_by_xpath('//*[@id="navbtn_references"]')
menu.click()

subMenu = driver.find_element_by_xpath('/html/body/nav[3]/div/div[1]/a[1]')
subMenu.click()

driver.quit()