<?xml version="1.0" encoding="GB2312"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:output method="html"/>

<xsl:template match="/">
	<body>
    	<table border="1" width="800" background="#575757">
        	<tr>
            	<td align="center" bgcolor="#999999">id</td>
            	<td align="center" bgcolor="#999999">����</td>
                <td align="center" bgcolor="#999999">�Ա�</td>
                <td align="center" bgcolor="#999999">����</td>
                <td align="center" bgcolor="#999999">����</td>
                <td align="center" bgcolor="#999999">��ַ</td>
          </tr>
            <xsl:for-each select="��ϵ���б�/��ϵ��">
            <tr>
            	<td align="center"><xsl:value-of select="ID"></xsl:value-of></td>
            	<td align="center"><xsl:value-of select="����"></xsl:value-of></td>
            	<td align="center"><xsl:value-of select="�Ա�"></xsl:value-of></td>
            	<td align="center"><xsl:value-of select="����"></xsl:value-of></td>
            	<td align="center"><xsl:value-of select="EMAIL"></xsl:value-of></td>
            	<td align="center"><xsl:value-of select="��ַ/����"></xsl:value-of>-<xsl:value-of select="��ַ/�ֵ�"></xsl:value-of></td>
            </tr>
            </xsl:for-each>
        </table>
    </body>
</xsl:template>
</xsl:stylesheet>