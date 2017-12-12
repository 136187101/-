function SetLanguage(val)
{
  var url = location.href;
  if(val=="1")
  {
    url= "?fids=1";
  }
  if(val=="2")
  {
    url= "?fids=2";
  }
  if(val=="3")
  {
    url= "?fids=3";
  }
  location.href=url;
}