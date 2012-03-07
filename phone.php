<GS_XML_Application>         
   <Display>
      <Screen>      
      <DisplayString halign="Center" valign="Center" font="f13b"> 
            <X>20</X>
            <Y>50</Y>         
            <DisplayStr>...</DisplayStr>      
         </DisplayString>      
      </Screen>   
   </Display>
            
   <SoftKeys>
      <SoftKey>
         <Label>CHOICE</Label>
         <Action>
            <UseURL>
               <URL>...</URL>               
            </UseURL>
         </Action>
   </SoftKeys>
      
   <Events> 
      <Event> 
         <State>Onhook</State> 
         <Action> 
            <QuitApp/> 
         </Action> 
      </Event> 
   </Events> 
</GS_XML_Application >