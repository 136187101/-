<?xml version="1.0" encoding="GB2312"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:output method="html"/>

<xsl:template match="/">
	<body>
    	<table border="1" width="800" background="#575757">
        	<tr>
            	<td align="center" bgcolor="#999999">id</td>
            	<td align="center" bgcolor="#999999">姓名</td>
                <td align="center" bgcolor="#999999">性别</td>
                <td align="center" bgcolor="#999999">年龄</td>
                <td align="center" bgcolor="#999999">邮箱</td>
                <td align="center" bgcolor="#999999">地址</td>
          </tr>
            <xsl:for-each select="联系人列表/联系人">
            <tr>
            	<td align="center"><xsl:value-of select="ID"></xsl:value-of></td>
            	<td align="center"><xsl:value-of select="姓名"></xsl:value-of></td>
            	<td align="center"><xsl:value-of select="性别"></xsl:value-of></td>
            	<td align="center"><xsl:value-of select="年龄"></xsl:value-of></td>
            	<td align="center"><xsl:value-of select="EMAIL"></xsl:value-of></td>
            	<td align="center"><xsl:value-of select="地址/城市"></xsl:value-of>-<xsl:value-of select="地址/街道"></xsl:value-of></td>
            </tr>
            </xsl:for-each>
        </table>
    </body>
</xsl:template>
</xsl:stylesheet>