from selenium import webdriver
from selenium.webdriver import ActionChains

driver = webdriver.Safari()
driver.get("https://www.w3schools.com")

menu = driver.find_elements_by_xpath('//*[@id="navbtn_references"]')
submenu = driver.find_elements_by_xpath('//*[@id="nav_references"]/div/div[1]/a[1]')


actions = ActionChains(driver)
actions.click(menu)
actions.click(submenu)
actions.pause(4)
actions.perform()

#image_2_drag = driver.find_elements_by_xpath('//*[@id="drag1"]')
#element_2_put = driver.find_elements_by_tag_name('#div2')

#actions = ActionChains(driver)
#actions.drag_and_drop(image_2_drag,element_2_put)#
#actions.click(element_2_put)
#actions.release()
#actions.perform()

driver.quit()
